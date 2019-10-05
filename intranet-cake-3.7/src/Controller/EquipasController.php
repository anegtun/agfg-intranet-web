<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class EquipasController extends AppController {

    public function index() {
        $this->set('equipas', $this->Equipas->find('all'));
    }

    public function detalle($id=null) {
        $equipa = empty($id) ? $this->Equipas->newEntity() : $this->Equipas->get($id);
        //if(!empty($id)) {
        //    $this->loadModel('Equipas');
        //    $equipas = $this->Equipas->find('all')->where(['id_clube'=>$id])->all();
        //    $this->set(compact('equipas'));
        //}
        $this->set(compact('equipa'));
    }

    public function gardar() {
        $equipa = $this->Equipas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $equipa = $this->Equipas->patchEntity($equipa, $this->request->data);
            if ($this->Equipas->save($equipa)) {
                $this->Flash->success(__('Gardouse a equipa correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar a equipa.'));
        }
        $this->set(compact('equipa'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $equipa = $this->Equipas->get($id);
        if($this->Equipas->delete($equipa)) {
            $this->Flash->success(__('Eliminouse a equipa correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a equipa.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
