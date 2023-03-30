<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class CamposController extends AppController {
    
    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $campos = $this->Campos
            ->find()
            ->order('pobo');
        $this->set(compact('campos'));
    }

    public function detalle($id=null) {
        $campo = $this->Campos->getOrNew($id);
        $this->set(compact('campo'));
    }

    public function gardar() {
        $campo = $this->Campos->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $campo = $this->Campos->patchEntity($campo, $this->request->getData());
            if ($this->Campos->save($campo)) {
                $this->Flash->success(__('Gardouse o campo correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o campo.'));
        }
        $this->set(compact('campo'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $campo = $this->Campos->get($id);
        if($this->Campos->delete($campo)) {
            $this->Flash->success(__('Eliminouse o campo correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o campo.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
