<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use App\Model\Tempadas;
use Cake\ORM\TableRegistry;

class EconomicoController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Tempadas = new Tempadas();
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
        $this->render('detalle');
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
        $areas = $this->Areas->find()->contain(['PartidaOrzamentaria'])->order(['PartidaOrzamentaria.nome', 'MovementosArea.nome']);
        $subareas = $this->Subareas->find()->contain(['Area'])->order('Area.nome');
        $movementos = $this->MovementosEconomicos->find($this->request, $prevision);
        $this->set(compact('prevision', 'movementos', 'contas', 'areas', 'subareas', 'tempadas'));
    }

}
