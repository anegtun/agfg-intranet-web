<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ArbitrosController extends AppController {
    
    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $arbitros = $this->Arbitros->find('all', ['order'=>'alcume']);
        $this->set(compact('arbitros'));
    }

    public function detalle($id=null) {
        $arbitro = empty($id) ? $this->Arbitros->newEntity() : $this->Arbitros->get($id);
        $this->set(compact('arbitro'));
    }

    public function gardar() {
        $arbitro = $this->Arbitros->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $arbitro = $this->Arbitros->patchEntity($arbitro, $this->request->getData());
            if ($this->Arbitros->save($arbitro)) {
                $this->Flash->success(__('Gardouse o arbitro correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o arbitro.'));
        }
        $this->set(compact('arbitro'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $arbitro = $this->Arbitros->get($id);
        if($this->Arbitros->delete($arbitro)) {
            $this->Flash->success(__('Eliminouse o arbitro correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o arbitro.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
