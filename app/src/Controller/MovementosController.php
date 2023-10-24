<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use App\Model\ResumoEconomico;
use App\Model\Tempadas;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class MovementosController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Areas = TableRegistry::get('MovementosArea');
        $this->Contas = new Contas();
        $this->Tempadas = new Tempadas();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->PartidasOrzamentarias = TableRegistry::get('MovementosPartidaOrzamentaria');
        $this->Subareas = TableRegistry::get('MovementosSubarea');
        $this->loadComponent('ResumoEconomicoPdf');
    }

    public function index() {
        $this->listarMovementos(false);
    }

    public function previsions() {
        $this->listarMovementos(true);
        $this->render('index');
    }

    private function listarMovementos($prevision) {
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $areas = $this->Areas->find()->contain(['PartidaOrzamentaria'])->order(['PartidaOrzamentaria.nome', 'MovementosArea.nome']);
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $movementos = $this->movementosFiltrados($prevision);
        $this->set(compact('prevision', 'movementos', 'contas', 'areas', 'subareas', 'tempadas'));
    }

    public function resumo() {
        $movementos = $this->movementosFiltrados(false);
        $previsions = $this->movementosFiltrados(true);
        $resumo = new ResumoEconomico($movementos, $previsions);

        $partidasOrzamentarias = $this->PartidasOrzamentarias->find()->order('nome');
        $areas = $this->Areas->find()->contain(['PartidaOrzamentaria'])->order(['PartidaOrzamentaria.nome', 'MovementosArea.nome']);
        $tempadas = $this->Tempadas->getTempadasWithEmpty();

        if($this->request->getQuery('accion') === 'pdf') {
            $content = $this->ResumoEconomicoPdf->generate($resumo, $tempadas, $this->request);

            $response = $this->response
                ->withStringBody($content)
                ->withType('application/pdf');
            if(!empty($this->request->getQuery('download'))) {
                $response = $response->withDownload($audit->getReportFilename());
            }
            return $response;
        }

        $this->set(compact('areas', 'movementos', 'partidasOrzamentarias', 'previsions', 'resumo', 'tempadas'));
    }

    public function resumoClubes() {
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $movementos = $this->movementosFiltrados();

        $resumo = [];
        $ids_subareas = [];
        foreach($movementos as $m) {
            if(!empty($m->clube)) {
                if(empty($resumo[$m->clube->id])) {
                    $resumo[$m->clube->id] = [];
                }
                if(empty($resumo[$m->clube->id][$m->subarea->id])) {
                    $resumo[$m->clube->id][$m->subarea->id] = 0;
                }
                $resumo[$m->clube->id][$m->subarea->id] += $m->importe;
                $ids_subareas[] = $m->subarea->id;
            }
        }

        $subareas = empty($ids_subareas) ? [] : $this->Subareas->find('all', ['order'=>'nome'])->where(['id IN' => $ids_subareas]);
        $clubes = empty($resumo) ? [] : $this->Clubes->find('all', ['order'=>'nome'])->where(['id IN' => array_keys($resumo)]);

        $this->set(compact('movementos', 'resumo', 'clubes', 'subareas', 'tempadas'));
    }

    public function detalle($id=null) {
        if(empty($id)) {
            $movemento = $this->Movementos->newEntity();
            $movemento->prevision = $this->request->getQuery('prevision', false);
        } else {
            $movemento = $this->Movementos->get($id);
        }
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $clubes = $this->Clubes->find()->order('nome');
        $subareas = $this->Subareas->find()->contain(['Area' => 'PartidaOrzamentaria'])->order('PartidaOrzamentaria.nome', 'Area.nome');
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas'));
    }

    public function clonar($id) {
        $movemento = $this->Movementos->get($id);
        $movemento->id = NULL;
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $clubes = $this->Clubes->find('all', ['order'=>'nome']);
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas'));
        $this->render('detalle');
    }

    public function gardar() {
        $movemento = $this->Movementos->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $movemento = $this->Movementos->patchEntity($movemento, $data);
            if(empty($data['id_clube'])) {
                $movemento->id_clube = NULL;
            }
            $movemento->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
            if ($this->Movementos->save($movemento)) {
                $this->Flash->success(__('Gardáronse os datos do movemento correctamente.'));
                return $this->redirect(['action' => $movemento->prevision ? 'previsions' : 'index']);
            }
            $this->Flash->error(__('Erro ao gardar os datos do movemento.'));
        }
        $this->set(compact('movemento'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $movemento = $this->Movementos->get($id);
        if($this->Movementos->delete($movemento)) {
            $this->Flash->success(__('Eliminouse o movemento correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o movemento.'));
        }
        return $this->redirect(['action' => $movemento->prevision ? 'previsions' : 'index']);
    }

    private function movementosFiltrados($prevision = false) {
        $sort = $prevision ? 'asc' : 'desc';
        $movementos = $this->Movementos
            ->find('all', ['order'=>["data $sort", "Movementos.id $sort"]])
            ->contain(['Subarea' => ['Area' => ['PartidaOrzamentaria']], 'Clube'])
            ->where(['prevision' => $prevision]);

        if(!empty($this->request->getQuery('data_ini'))) {
            $movementos->where(['data >=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_ini'))]);
        }
        if(!empty($this->request->getQuery('data_fin'))) {
            $movementos->where(['data <=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_fin'))]);
        }
        if(!empty($this->request->getQuery('conta'))) {
            $movementos->where(['conta' => $this->request->getQuery('conta')]);
        }
        if(!empty($this->request->getQuery('tempada'))) {
            $movementos->where(['tempada' => $this->request->getQuery('tempada')]);
        }
        if(!empty($this->request->getQuery('id_partida_orzamentaria'))) {
            $movementos->where(['Area.id_partida_orzamentaria' => $this->request->getQuery('id_partida_orzamentaria')]);
        }
        if(!empty($this->request->getQuery('id_area'))) {
            $movementos->where(['Subarea.id_area' => $this->request->getQuery('id_area')]);
        }
        if(!empty($this->request->getQuery('id_subarea'))) {
            $movementos->where(['id_subarea' => $this->request->getQuery('id_subarea')]);
        }
        return $movementos;
    }

    private static function cmpResumo($a, $b) {
        $cmp = strcmp($a->subarea->area->nome, $b->subarea->area->nome);
        if($cmp===0) {
            $cmp = strcmp($a->subarea->nome, $b->subarea->nome);
        }
        if($cmp===0) {
            $cmp = strcmp($b->tempada, $a->tempada);
        }
        return $cmp;
    }

}
