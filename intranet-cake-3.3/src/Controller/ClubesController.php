<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ClubesController extends AppController {

    public function index() {
        $this->set('clubes', $this->Clubes->find('all'));
    }

    public function detalle($id=null) {
        $clube = empty($id) ? $this->Clubes->newEntity() : $this->Clubes->get($id);
        if(!empty($id)) {
            $this->loadModel('Equipas');
            $equipas = $this->Equipas->find('all')->where(['id_clube'=>$id])->all();
            $this->set(compact('equipas'));
        }
        $this->set(compact('clube'));
    }

    public function gardar() {
        $clube = $this->Clubes->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $clube = $this->Clubes->patchEntity($clube, $this->request->data);
            if ($this->Clubes->save($clube)) {
                $this->Flash->success(__('Gardouse o clube correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o clube.'));
        }
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



    public function detalleEquipa($idClube, $id=null) {
        $this->loadModel('Equipas');
        $equipa = null;
        if(empty($id)) {
            $equipa = $this->Equipas->newEntity();
            $equipa->id_clube = $idClube;
        } else {
            $equipa = $this->Equipas->get($id);
        }
        $this->set(compact('equipa'));
    }

    public function gardarEquipa() {
        $this->loadModel('Equipas');
        $equipa = $this->Equipas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $equipa = $this->Equipas->patchEntity($equipa, $this->request->data);
            if ($this->Equipas->save($equipa)) {
                $this->Flash->success(__('Gardouse a equipa correctamente.'));
                return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
            }
            $this->Flash->error(__('Erro ao gardar a equipa.'));
        }
        $this->set(compact('equipa'));
        $this->render('detalleEquipa');
    }

    public function borrarEquipa($id) {
        $this->loadModel('Equipas');
        $equipa = $this->Equipas->get($id);
        if($this->Equipas->delete($equipa)) {
            $this->Flash->success(__('Eliminouse a equipa correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a equipa.'));
        }
        return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
    }

}
