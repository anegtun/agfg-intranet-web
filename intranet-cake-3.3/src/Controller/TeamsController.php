<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class TeamsController extends AppController {

    public function index() {
        $this->set('teams', $this->Teams->find('all'));
    }

    public function detail($id=null) {
        $team = empty($id) ? $this->Teams->newEntity() : $this->Teams->get($id);
        $this->set(compact('team'));
    }

    public function save() {
        $team = $this->Teams->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $team = $this->Teams->patchEntity($team, $this->request->data);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('Gardouse o equipo correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o equipo.'));
        }
        $this->set(compact('team'));
        $this->render('detail');
    }

    public function delete($id) {
        $team = $this->Teams->get($id);
        if($this->Teams->delete($team)) {
            $this->Flash->success(__('Eliminouse o equipo correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o equipo.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
