<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class EquipasController extends AppController {

    public function index() {
        $this->set('equipas', $this->Equipas->find('all'));
    }

    public function detail($id=null) {
        $equipa = empty($id) ? $this->Equipas->newEntity() : $this->Equipas->get($id);
        $this->set(compact('equipa'));
    }

    public function save() {
        $equipa = $this->Equipas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $equipa = $this->Equipas->patchEntity($equipa, $this->request->data);
            if ($this->Equipas->save($equipa)) {
                $this->Flash->success(__('Gardouse o equipo correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o equipo.'));
        }
        $this->set(compact('equipa'));
        $this->render('detail');
    }

    public function delete($id) {
        $equipa = $this->Equipas->get($id);
        if($this->Equipas->delete($equipa)) {
            $this->Flash->success(__('Eliminouse o equipo correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o equipo.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
