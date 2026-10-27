<?php
namespace App\Controller;

use App\Model\Categorias;
use Cake\Collection\CollectionInterface;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\Event;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class ResultadosController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Arbitros = TableRegistry::get('Arbitros');
        $this->Campos = TableRegistry::get('Campos');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
    }

    public function competicion($id) {
        $categorias = $this->Categorias->getCategorias();
        $competicion = $this->Competicions->get($id, ['contain'=>['Fases.Equipas']]);
        $equipas = [];
        foreach ($competicion->fases as $fase) {
            foreach ($fase->equipas as $equipa) {
                $equipas[$equipa->id] = $equipa;
            }
        }
        $collator = new \Collator('gl_ES');
        usort($equipas, function ($equipaA, $equipaB) use ($collator) {
            return $collator->compare($equipaA->nome, $equipaB->nome);
        });

        $partidos_competicion = $this->Partidos->find()
            ->contain(['Fase', 'Campo'])
            ->where(['Fase.id_competicion'=>$id]);
  
        $partidos_filtrados = $this->Partidos
            ->find()
            ->contain(['Fase' => 'Competicion', 'Xornada', 'Equipa1'=>'Clube', 'Equipa2'=>'Clube', 'Campo', 'Arbitro', 'Umpire'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornada.data)'])
            ->enableAutoFields(true)
            ->where(['Fase.id_competicion'=>$id])
            ->order(['data_calendario', 'hora_partido', 'Equipa1.nome'])
            ->formatResults(function (CollectionInterface $results) {
                return $results->map(function ($row) {
                    if (!empty($row['data_calendario'])) {
                        $row['data_calendario'] = FrozenDate::createFromFormat('Y-m-d', $row['data_calendario']);
                    }
                    return $row;
                });
            });
        if(!empty($this->request->getQuery('categoria'))) {
            $partidos_filtrados->where(['Fase.categoria' => $this->request->getQuery('categoria')]);
        }
        if(!empty($this->request->getQuery('id_fase'))) {
            $partidos_filtrados->where(['Partidos.id_fase' => $this->request->getQuery('id_fase')]);
        }
        if(!empty($this->request->getQuery('id_campo'))) {
            $partidos_filtrados->where(['Partidos.id_campo' => $this->request->getQuery('id_campo')]);
        }
        if(!empty($this->request->getQuery('id_equipa'))) {
            $id_equipa = $this->request->getQuery('id_equipa');
            $partidos_filtrados->where(['OR' => [
                'Partidos.id_equipa1' => $id_equipa,
                'Partidos.id_equipa2' => $id_equipa,
            ]]);
        }
        $pendente = $this->request->getQuery('pendente');
        if(!isset($pendente) || !empty($pendente)) {
            $partidos_filtrados->where(function (QueryExpression $exp, Query $query) {
                $goles = $query->newExpr()->isNull('Partidos.goles_equipa1');
                $tantos = $query->newExpr()->isNull('Partidos.tantos_equipa1');
                $total = $query->newExpr()->isNull('Partidos.total_equipa1');
                return $exp->and([$goles, $tantos, $total]);
            });
        }

        $this->set(compact('categorias', 'equipas', 'competicion', 'partidos_filtrados', 'partidos_competicion'));
    }

    public function resumo($id) {
        $competicion = $this->Competicions->get($id, ['contain'=>['Fases']]);

        $partidos = $this->Partidos
            ->find()
            ->contain(['Fase', 'Xornada', 'Equipa1'=>'Clube', 'Equipa2'=>'Clube', 'Campo', 'Arbitro', 'Umpire'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornada.data)'])
            ->enableAutoFields(true)
            ->where(['Fase.id_competicion'=>$id])
            ->order(['data_calendario', 'hora_partido', 'Equipa1.nome'])
            ->formatResults(function (CollectionInterface $results) {
                return $results->map(function ($row) {
                    if (!empty($row['data_calendario'])) {
                        $row['data_calendario'] = FrozenDate::createFromFormat('Y-m-d', $row['data_calendario']);
                    }
                    return $row;
                });
            });

        $this->set(compact('competicion', 'partidos'));
    }

    public function reemplazar($id) {
        $this->competicion($id);
        $competicion = $this->Competicions->get($id);
        $equipas_competicion = $this->Equipas->findInFederacion($competicion->id_federacion);
        $this->set(compact('equipas_competicion'));
    }

    public function gardarReemplazo() {
        $data = $this->request->getData();
        if(!empty($data['id_competicion']) && !empty($data['id_orixinal']) && !empty($data['id_nova'])) {
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fase'])
                ->where(['Fase.id_competicion' => $data['id_competicion'], 'id_equipa1' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_equipa1 = $data['id_nova'];
                $this->Partidos->save($p);
            }
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fase'])
                ->where(['Fase.id_competicion' => $data['id_competicion'], 'id_equipa2' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_equipa2 = $data['id_nova'];
                $this->Partidos->save($p);
            }
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fase'])
                ->where(['Fase.id_competicion' => $data['id_competicion'], 'id_umpire' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_umpire = $data['id_nova'];
                $this->Partidos->save($p);
            }
        }
        return $this->redirect(['action'=>'competicion', $data['id_competicion']]);
    }

    public function partido($id) {
        $partido = $this->Partidos->getDetalle($id);
        $urlReferrer = $this->getSafeUrlReferrer($this->request->getQuery('urlReferrer'));

        $arbitros = $this->Arbitros->findMap(true);
        if ($partido->id_arbitro) {
            $arbitros[$partido->id_arbitro] = $this->Arbitros->get($partido->id_arbitro);
        }
        $campos = $this->Campos->findMap(true);
        if ($partido->id_campo) {
            $campos[$partido->id_campo] = $this->Campos->get($partido->id_campo);
        }
        $umpires = $this->Equipas->findInFederacion($partido->fase->competicion->id_federacion);
        $categorias = $this->Categorias->getCategorias();
        $this->set(compact('partido', 'arbitros', 'campos', 'umpires', 'categorias', 'urlReferrer'));
    }

    public function gardar() {
        $data = $this->request->getData();
        $urlReferrer = $this->getSafeUrlReferrer($data['urlReferrer'] ?? null);
        unset($data['urlReferrer']);
        $partido = $this->Partidos->get($data['id']);
        $partido = $this->processGameForm($partido, $data);
        if ($this->Partidos->save($partido)) {
            $this->Flash->success(__('Gardáronse os datos do partido correctamente.'));
            if ($urlReferrer !== null) {
                return $this->redirect($urlReferrer);
            }
            return $this->redirect(['action'=>'competicion', $data['id_competicion']]);
        }
        $this->Flash->error(__('Erro ao gardar os datos do partido.'));
        $this->set(compact('partido', 'urlReferrer'));
        $this->render('partido');
    }

    private function getSafeUrlReferrer($urlReferrer): ?string {
        if (!is_string($urlReferrer) || $urlReferrer === '' || $urlReferrer[0] !== '/' || str_starts_with($urlReferrer, '//') || strpos($urlReferrer, '\\') !== false || preg_match('/[\r\n]/', $urlReferrer)) {
            return null;
        }

        $parts = parse_url($urlReferrer);
        if ($parts === false || isset($parts['scheme']) || isset($parts['host'])) {
            return null;
        }

        return $urlReferrer;
    }

    /**
     * Procesa o formulario dun partido
     */
    private function processGameForm($partido, $data) {
        $p = $this->Partidos->patchEntity($partido, $data);
        $p->data_partido = empty($data['data']) ? NULL : FrozenTime::createFromFormat('d-m-Y', $data['data']);
        $p->id_campo = $this->clean($data['id_campo']);
        $p->id_arbitro = $this->clean($data['id_arbitro']);
        $p->goles_equipa1 = isset($data['goles_equipa1']) ? $this->clean($data['goles_equipa1']) : NULL;
        $p->tantos_equipa1 = isset($data['tantos_equipa1']) ? $this->clean($data['tantos_equipa1']) : NULL;
        if(isset($data['total_equipa1'])) {
            $p->total_equipa1 = $this->clean($data['total_equipa1']);
        }
        $p->goles_equipa2 = isset($data['goles_equipa2']) ? $this->clean($data['goles_equipa2']) : NULL;
        $p->tantos_equipa2 = isset($data['tantos_equipa2']) ? $this->clean($data['tantos_equipa2']) : NULL;
        if(isset($data['total_equipa2'])) {
            $p->total_equipa2 = $this->clean($data['total_equipa2']);
        }
        $p->sancion_puntos_equipa1 = $this->clean($data['sancion_puntos_equipa1']);
        $p->sancion_puntos_equipa2 = $this->clean($data['sancion_puntos_equipa2']);
        if(!is_null($p->goles_equipa1) || !is_null($p->tantos_equipa1)) {
            $p->total_equipa1 = NULL;
        }
        if(!is_null($p->goles_equipa2) || !is_null($p->tantos_equipa2)) {
            $p->total_equipa2 = NULL;
        }
        return $p;
    }

    /**
     * Forza NULL en caso de cadea baleira
     */
    private function clean($str) {
        return $str==='' ? NULL : $str;
    }
    
}
