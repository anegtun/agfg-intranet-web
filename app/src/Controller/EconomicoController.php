<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use App\Model\ResumoEconomico;
use App\Model\Tempadas;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class EconomicoController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Tempadas = new Tempadas();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->PartidasOrzamentarias = TableRegistry::get('MovementosPartidaOrzamentaria');
        $this->Areas = TableRegistry::get('MovementosArea');
        $this->Subareas = TableRegistry::get('MovementosSubarea');
        $this->Movementos = TableRegistry::get('Movementos');
        $this->loadComponent('MovementosEconomicos');
        $this->loadComponent('ResumoEconomicoPdf');
    }

    public function index() {
        $this->redirect(['action' => 'movementos']);
    }

    public function movementos() {
        $this->listarMovementos(false);
        $this->render('movementos');
    }

    public function previsions() {
        $this->listarMovementos(true);
        $this->render('movementos');
    }

    public function resumo() {
        $movementos = $this->MovementosEconomicos->find($this->request, false);
        $previsions = $this->MovementosEconomicos->find($this->request, true);
        $resumo = new ResumoEconomico($movementos, $previsions);

        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();

        if($this->request->getQuery('accion') === 'pdf') {
            $content = $this->ResumoEconomicoPdf->generate($resumo, $tempadas, $this->request);
            $response = $this->response->withStringBody($content)->withType('application/pdf');
            if(!empty($this->request->getQuery('download'))) {
                $response = $response->withDownload($content->getReportFilename());
            }
            return $response;
        }

        $this->set(compact('resumo', 'partidasOrzamentarias', 'tempadas'));
    }

    public function resumoClubes() {
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $movementos = $this->MovementosEconomicos->find($this->request, false);

        // TODO Mellorar
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

    public function detalleMovemento($id=null) {
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

    public function clonarMovemento($id) {
        $movemento = $this->Movementos->get($id);
        $movemento->id = NULL;
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $clubes = $this->Clubes->find()->order('nome');
        $subareas = $this->Subareas->find()->contain(['Area' => 'PartidaOrzamentaria'])->order('PartidaOrzamentaria.nome', 'Area.nome');
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas'));
        $this->render('detalleMovemento');
    }

    public function gardarMovemento() {
        $movemento = $this->Movementos->newEntity();
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
        $this->set(compact('movemento'));
        $this->render('detalle');
    }

    public function borrarMovemento($id) {
        $movemento = $this->Movementos->get($id);
        if($this->Movementos->delete($movemento)) {
            $this->Flash->success(__('Eliminouse o movemento correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o movemento.'));
        }
        return $this->redirect(['action' => $movemento->prevision ? 'previsions' : 'index']);
    }

    public function partidasOrzamentarias() {
        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $this->set(compact('partidasOrzamentarias'));
    }

    public function detallePartidaOrzamentaria($id=null) {
        $partidaOrzamentaria = empty($id) ? $this->PartidasOrzamentarias->newEntity() : $this->PartidasOrzamentarias->get($id);
        $this->set(compact('partidaOrzamentaria'));
    }

    public function gardarPartidaOrzamentaria() {
        $partidaOrzamentaria = $this->PartidasOrzamentarias->newEntity();
        $partidaOrzamentaria = $this->PartidasOrzamentarias->patchEntity($partidaOrzamentaria, $this->request->getData());
        if ($this->PartidasOrzamentarias->save($partidaOrzamentaria)) {
            $this->Flash->success(__('Gardouse a partida orzamentaria correctamente.'));
            return $this->redirect(['action'=>'partidasOrzamentarias']);
        }
        $this->Flash->error(__('Erro ao gardar a partida orzamentaria.'));
        $this->set(compact('partidaOrzamentaria'));
        $this->render('detallePartidaOrzamentaria');
    }

    public function borrarPartidaOrzamentaria($id) {
        if($this->PartidasOrzamentarias->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a partida orzamentaria correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a partida orzamentaria.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    public function detalleArea($id=null) {
        $area = $this->Areas->getOrNew($id);
        $partidasOrzamentarias = $this->PartidasOrzamentarias->find()->order('nome');
        $this->set(compact('area', 'partidasOrzamentarias'));
    }

    public function gardarArea() {
        $area = $this->Areas->newEntity();
        $area = $this->Areas->patchEntity($area, $this->request->getData());
        if ($this->Areas->save($area)) {
            $this->Flash->success(__('Gardouse a área correctamente.'));
            return $this->redirect(['action'=>'partidasOrzamentarias']);
        }
        $this->Flash->error(__('Erro ao gardar a área.'));
        $this->set(compact('area'));
        $this->render('detalleArea');
    }

    public function borrarArea($id) {
        if($this->Areas->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a área correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a área.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    public function detalleSubarea($id=null) {
        $subarea = $this->Subareas->getOrNew($id);
        $areas = $this->Areas->find()->contain(['PartidaOrzamentaria'])->order(['PartidaOrzamentaria.nome', 'MovementosArea.nome']);
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $movementos = empty($id) ? [] : $this->Movementos->find()->where(['id_subarea' => $id]);
        $this->set(compact('subarea', 'areas', 'movementos', 'contas', 'tempadas'));
    }

    public function gardarSubarea() {
        $subarea = $this->Subareas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $subarea = $this->Subareas->patchEntity($subarea, $this->request->getData());
            if ($this->Subareas->save($subarea)) {
                $this->Flash->success(__('Gardouse a subárea correctamente.'));
                return $this->redirect(['action'=>'partidasOrzamentarias']);
            }
            $this->Flash->error(__('Erro ao gardar a subárea.'));
        }
        $this->set(compact('subarea'));
        $this->render('detalleSubarea');
    }

    public function borrarSubarea($id) {
        if($this->Subareas->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a subárea correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a subárea.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    private function listarMovementos($prevision) {
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $movementos = $this->MovementosEconomicos->find($this->request, $prevision);
        $this->set(compact('prevision', 'contas', 'tempadas', 'partidasOrzamentarias', 'movementos'));
    }

}
