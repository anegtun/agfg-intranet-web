<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use Cake\Event\Event;

class EquipasController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Categorias = new Categorias();
    }

    public function index() {
        $categorias = $this->Categorias->getCategorias();
        $equipas = $this->Equipas->find('all', ['order'=>'codigo','categoria']);
        $this->set(compact('categorias', 'equipas'));
    }

    public function detalle($id=null) {
        $categorias = $this->Categorias->getCategorias();
        $equipa = empty($id) ? $this->Equipas->newEntity() : $this->Equipas->get($id);
        $this->set(compact('categorias', 'equipa'));
    }

    public function gardar() {
        $equipa = $this->Equipas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $equipa = $this->Equipas->patchEntity($equipa, $this->request->getData());
            if ($this->Equipas->save($equipa)) {
                $this->Flash->success(__('Gardouse a equipa correctamente.'));
                return $this->redirect(array('action'=>'index'));
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
        return $this->redirect(array('action'=>'index'));
    }

}
