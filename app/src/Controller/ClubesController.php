<?php
namespace App\Controller;

use App\Model\Categorias;
use App\Model\TiposCompeticion;
use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

class ClubesController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->EquipasAmalgamas = TableRegistry::get('EquipasAmalgamas');
        $this->FasesEquipas = TableRegistry::get('FasesEquipas');
        $this->Federacions = TableRegistry::get('Federacions');
        $this->Tempadas = TableRegistry::get('Tempadas');
        $this->loadComponent('ClasificacionFetcher');
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['palmares']);
    }

    public function index() {
        $federacions = $this->Federacions->find()->order('codigo');
        $clubes = $this->Clubes->find()->contain(['Equipas', 'Federacions'])->order('Clubes.codigo');

        if (!empty($this->request->getQuery('id_federacion'))) {
            $clubes->matching('Federacions', function ($q) {
                return $q->where(['Federacions.id' => $this->request->getQuery('id_federacion')]);
            });
        }
        
        $this->set(compact('clubes', 'federacions'));
    }

    public function detalle($id=null) {
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $federacions = $this->Federacions->find()->order('codigo');
        $clube = $this->Clubes->getOrNew($id, ['contain' => [
            'Equipas' => [
                'sort' => 'Equipas.codigo',
                'Clube',
                'ClubesAmalgamas'
            ],
            'Federacions'
        ]]);

        $this->set(compact('clube', 'categorias', 'federacions'));
    }

    public function gardar() {
        $data = $this->request->getData();
        $clube = $this->Clubes->newEntity($data);
        $clube->federacions = $this->Federacions->find()->where(['id IN' => $data['federacions']])->toArray();
        $clube->setDirty('federacions', true);
        if ($this->Clubes->save($clube)) {
            $this->Flash->success(__('Gardouse o clube correctamente.'));
            return $this->redirect(['action'=>'index']);
        }
        $this->Flash->error(__('Erro ao gardar o clube.'));
        $this->set(compact('clube'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $clube = $this->Clubes->get($id);
        if($this->Clubes->delete($clube)) {
            $this->Flash->success(__('Eliminouse o clube correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o clube.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function detalleEquipa($id=null) {
        if(empty($id)) {
            $equipa = $this->Equipas->newEntity([]);
            $equipa->id_clube = $this->request->getQuery('idClube');
            $equipa->clube = $this->Clubes->get($equipa->id_clube);
            $equipa->clubes_amalgamas = [];
        } else {
            $equipa = $this->Equipas->get($id, ['contain'=>['Clube']]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $clubesAmalgamas = $this->Clubes->getClubesAmalgama($equipa->id_clube);
        $clubesAmalgamasSeleccionados = $this->EquipasAmalgamas
            ->getIdsClubesAmalgamaSeleccionados($equipa->id ?? null);
        $this->set(compact('categorias', 'equipa', 'clubesAmalgamas', 'clubesAmalgamasSeleccionados'));
    }

    public function gardarEquipa() {
        $data = $this->request->getData();
        $clubesAmalgamasSeleccionados = $data['clubes_amalgamas'] ?? [];
        if (!is_array($clubesAmalgamasSeleccionados)) {
            $this->Flash->error(__('A selección de clubes da amalgama non é válida.'));
            return $this->redirect(['action'=>'detalleEquipa', $data['id'] ?? null, '?' => ['idClube' => $data['id_clube'] ?? null]]);
        }

        $idsClubesAmalgama = [];
        foreach ($clubesAmalgamasSeleccionados as $idClube) {
            if ($idClube === '' || $idClube === null) {
                continue;
            }
            $idClubeValidado = filter_var($idClube, FILTER_VALIDATE_INT);
            if ($idClubeValidado === false || $idClubeValidado < 1) {
                $this->Flash->error(__('A selección de clubes da amalgama non é válida.'));
                return $this->redirect(['action'=>'detalleEquipa', $data['id'] ?? null, '?' => ['idClube' => $data['id_clube'] ?? null]]);
            }
            $idsClubesAmalgama[] = $idClubeValidado;
        }
        $idsClubesAmalgama = array_values(array_unique($idsClubesAmalgama));

        $amalgama = !empty($data['amalgama']);
        if (!$amalgama) {
            $idsClubesAmalgama = [];
        }

        if (!empty($idsClubesAmalgama)) {
            $clubesValidos = $this->Clubes->find()
                ->where([
                    'id IN' => $idsClubesAmalgama,
                    'id !=' => $data['id_clube']
                ])
                ->all()
                ->extract('id')
                ->toList();
            if (count($clubesValidos) !== count($idsClubesAmalgama)) {
                $this->Flash->error(__('A selección debe conter clubes existentes distintos do clube principal.'));
                return $this->redirect(['action'=>'detalleEquipa', $data['id'] ?? null, '?' => ['idClube' => $data['id_clube'] ?? null]]);
            }
        }

        $datosEquipa = $data;
        unset($datosEquipa['clubes_amalgamas']);
        $equipa = $this->Equipas->getOrNew($data['id'] ?? null, ['contain' => ['Clube']]);
        $equipa = $this->Equipas->patchEntity($equipa, $datosEquipa);
        $equipa->amalgama = $amalgama ? 1 : 0;

        $gardado = $this->Equipas->getConnection()->transactional(function () use ($equipa, $idsClubesAmalgama) {
            if (!$this->Equipas->save($equipa)) {
                return false;
            }

            $this->EquipasAmalgamas->deleteAll(['id_equipa' => $equipa->id]);
            foreach ($idsClubesAmalgama as $idClube) {
                $relacion = $this->EquipasAmalgamas->newEntity([
                    'id_equipa' => $equipa->id,
                    'id_clube' => $idClube
                ]);
                if (!$this->EquipasAmalgamas->save($relacion)) {
                    return false;
                }
            }

            return true;
        });

        if ($gardado) {
            $this->Flash->success(__('Gardouse a equipa correctamente.'));
            return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
        }

        $this->Flash->error(__('Erro ao gardar a equipa.'));
        $equipa->clube = $this->Clubes->get($equipa->id_clube);
        $equipa->clubes_amalgamas = $this->Clubes->find()->where(['id IN' => $idsClubesAmalgama])->toArray();
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $clubesAmalgamas = $this->Clubes->find('list', ['keyField' => 'id', 'valueField' => 'nome'])
            ->where(['id !=' => $equipa->id_clube])
            ->order(['nome'])
            ->toArray();
        $clubesAmalgamasSeleccionados = array_map('strval', $idsClubesAmalgama);
        $this->set(compact('equipa', 'categorias', 'clubesAmalgamas', 'clubesAmalgamasSeleccionados'));
        $this->render('detalleEquipa');
    }

    public function borrarEquipa($id) {
        $equipa = $this->Equipas->get($id);
        if($this->Equipas->delete($equipa)) {
            $this->Flash->success(__('Eliminouse a equipa correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a equipa.'));
        }
        return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
    }

    public function palmares($codigo) {
        if(empty($codigo)) {
            throw new Exception("Hai que especificar un clube");
        }

        $categoria = $this->request->getQuery('categoria');
        $tipo = $this->request->getQuery('tipo');
        $tempada = $this->request->getQuery('tempada');

        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $tempadas = $this->Tempadas->find()->order('codigo DESC');

        $clube = $this->Clubes
            ->find()
            ->contain(['Equipas', 'Federacions'])
            ->where(['Clubes.codigo' => $codigo])
            ->first();

        $idsEquipasAmalgama = $this->EquipasAmalgamas->find()
            ->select(['id_equipa'])
            ->where(['id_clube' => $clube->id])
            ->all()
            ->extract('id_equipa')
            ->toList();
        if (!empty($idsEquipasAmalgama)) {
            $equipasAmalgama = $this->Equipas
                ->find()
                ->where([
                    'Equipas.id IN' => $idsEquipasAmalgama,
                    'Equipas.id_clube !=' => $clube->id,
                    'Equipas.amalgama' => true
                ])
                ->contain(['Clube'])
                ->toArray();

            foreach ($equipasAmalgama as $equipaAmalgama) {
                $equipaAmalgama->palmares_amalgama = true;
                $clube->equipas[] = $equipaAmalgama;
            }
        }

        foreach($clube->equipas as $e) {
            $e->palmares_amalgama = $e->palmares_amalgama ?? false;
            $e->competicions = [];

            if(!empty($categoria) && $categoria != $e->categoria) {
                continue;
            }

            $equipasFases = $this->FasesEquipas
                ->find()
                ->contain(['Fases' => ['Competicion' => ['Federacion', 'Fases']]])
                ->where(['id_equipa' => $e->id])
                ->toArray();

            $ids_competicions = $ids_fases = [];
            foreach($equipasFases as $ef) {
                $ids_competicions[] = $ef->fase->competicion->id;
                $ids_fases[] = $ef->fase->id;
            }

            if (empty($ids_competicions)) {
                continue;
            }

            $competicions_query = [
                'Competicions.id IN' => $ids_competicions,
                'Federacion.codigo' => 'AGFG',
                'Competicions.finalizada' => 1,
                'Competicions.tipo !=' => TiposCompeticion::AMIGABLE,
            ];
            if(!empty($tempada)) {
                $competicions_query['Competicions.tempada'] = $tempada;
            }
            if(!empty($tipo)) {
                $competicions_query['Competicions.tipo'] = $tipo;
            }

            $competicions = $this->Competicions
                ->find()
                ->contain(['Federacion', 'Fases'])
                ->where($competicions_query)
                ->toArray();

            foreach($competicions as $c) {
                $clasificacion = $this->ClasificacionFetcher->get($c, $e->categoria);
                if ($c->isLiga()) {
                    $clasificacionsFinais = $this->_clasificacionFinalLiga($c, $e, $clasificacion);
                    $c->clasificacion = $clasificacionsFinais['global'];
                } elseif ($c->isTorneoOuEliminatoria()) {
                    $clasificacionsFinais = $this->_clasificacionFinalTorneo($c, $e, $clasificacion);
                    if (empty($clasificacionsFinais['fases'])) {
                        $clasificacion->build();
                        $c->clasificacion = $clasificacion->getClasificacionEquipa($e->id);
                    } else {
                        $c->clasificacion = $clasificacionsFinais['global'];
                    }
                } else {
                    $clasificacion->build();
                    $c->clasificacion = $clasificacion->getClasificacionEquipa($e->id);
                }

                foreach($c->fases as $f) {
                    if(!in_array($f->id, $ids_fases)) {
                        continue;
                    }
                    if (($c->isLiga() || $c->isTorneoOuEliminatoria()) && !empty($f->final)) {
                        $f->clasificacion = $clasificacionsFinais['fases'][$f->id] ?? null;
                    } else {
                        $clasificacion->build($f);
                        $f->clasificacion = $clasificacion->getClasificacionEquipa($e->id);
                    }
                }

                $e->competicions[$c->id] = $c;
            }
        }

        $this->set(compact('categorias', 'clube', 'tempadas'));
    }

    private function _clasificacionFinalLiga($competicion, $equipa, $clasificacion): array {
        $fasesFinais = array_values(array_filter($competicion->fases, function ($fase) use ($equipa) {
            return !empty($fase->final) && $fase->categoria === $equipa->categoria;
        }));
        usort($fasesFinais, function ($faseA, $faseB) {
            return (int)$faseB->prioridade <=> (int)$faseA->prioridade;
        });

        if (empty($fasesFinais)) {
            return ['global' => null, 'fases' => []];
        }

        $idsFasesFinais = array_map(function ($fase) {
            return $fase->id;
        }, $fasesFinais);
        $participacions = $this->FasesEquipas
            ->find()
            ->contain(['Fases'])
            ->where([
                'Fases.id_competicion' => $competicion->id,
                'Fases.categoria' => $equipa->categoria,
                'Fases.final' => 1
            ])
            ->toArray();

        $participacionsPorFase = [];
        $fasesFinaisDaEquipa = [];
        foreach ($participacions as $participacion) {
            if (!in_array($participacion->fase->id, $idsFasesFinais)) {
                continue;
            }
            $participacionsPorFase[$participacion->fase->id][] = $participacion;
            if ((string)$participacion->id_equipa === (string)$equipa->id) {
                $fasesFinaisDaEquipa[] = $participacion->fase->id;
            }
        }

        $fasesClasificadas = [];
        $posicionGlobal = null;
        $desprazamento = 0;
        foreach ($fasesFinais as $fase) {
            $equipasFase = $participacionsPorFase[$fase->id] ?? [];
            $clasificacionFase = [];
            if ($fase->formato === 'eliminatoria') {
                foreach ($equipasFase as $participacion) {
                    $clasificacionFase[] = (object)[
                        'id' => $participacion->id_equipa,
                        'posicion' => empty($participacion->posicion) ? null : (int)$participacion->posicion
                    ];
                }
            } else {
                $clasificacion->build($fase);
                $clasificacionFase = $clasificacion->getClasificacion();
            }

            $clasificacionEquipa = null;
            foreach ($clasificacionFase as $equipaClasificada) {
                if ((string)$equipaClasificada->id === (string)$equipa->id) {
                    $clasificacionEquipa = $equipaClasificada;
                    break;
                }
            }
            $fasesClasificadas[$fase->id] = $clasificacionEquipa;

            if (
                count($fasesFinaisDaEquipa) === 1 &&
                (string)$fasesFinaisDaEquipa[0] === (string)$fase->id &&
                $clasificacionEquipa !== null &&
                !empty($clasificacionEquipa->posicion)
            ) {
                $posicionGlobal = $desprazamento + (int)$clasificacionEquipa->posicion;
            }

            $desprazamento += count($equipasFase);
        }

        $clasificacionGlobal = $posicionGlobal === null
            ? null
            : (object)['posicion' => $posicionGlobal];

        return [
            'global' => $clasificacionGlobal,
            'fases' => $fasesClasificadas
        ];
    }

    private function _clasificacionFinalTorneo($competicion, $equipa, $clasificacion): array {
        $fasesFinais = array_values(array_filter($competicion->fases, function ($fase) use ($equipa) {
            return !empty($fase->final) && $fase->categoria === $equipa->categoria;
        }));
        usort($fasesFinais, function ($faseA, $faseB) {
            return (int)$faseB->prioridade <=> (int)$faseA->prioridade;
        });

        $fasesClasificadas = [];
        $numeroFasesEquipa = 0;
        $desprazamento = 0;
        $desprazamentoEquipa = 0;
        $posicionFaseEquipa = null;
        foreach ($fasesFinais as $fase) {
            $clasificacion->build($fase);
            $clasificacionFase = $clasificacion->getClasificacion();
            $clasificacionEquipa = $clasificacion->getClasificacionEquipa($equipa->id);
            $fasesClasificadas[$fase->id] = $clasificacionEquipa;

            if ($clasificacionEquipa !== null) {
                $numeroFasesEquipa++;
                $desprazamentoEquipa = $desprazamento;
                $posicionFaseEquipa = $clasificacionEquipa->posicion;
            }

            $desprazamento += count($clasificacionFase);
        }

        $posicionGlobal = $numeroFasesEquipa === 1 && !empty($posicionFaseEquipa)
            ? $desprazamentoEquipa + (int)$posicionFaseEquipa
            : null;
        $clasificacionGlobal = $posicionGlobal === null
            ? null
            : (object)['posicion' => $posicionGlobal];

        return [
            'global' => $clasificacionGlobal,
            'fases' => $fasesClasificadas
        ];
    }

}
