<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsuariosController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(array('add'));
    }
    
    

    public function index() {
        $this->set('usuarios', $this->Usuarios->find('all'));
    }

    public function view($id) {
        $usuario = $this->Usuarios->get($id);
        $this->set(compact('usuario'));
    }

    public function add() {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Creouse o usuario correctamente.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Erro ao crear o usuario.'));
        }
        $this->set('usuario', $usuario);
    }

    public function edit($id = null) {
        if (!$this->Usuarios->exists(array('id'=>$id))) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usuarios->save($this->request->data)) {
                $this->Flash->success(__('O usuario gardouse correctamente.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Erro ao gardar o usuario.'));
        } else {
            $usuario = $this->Usuarios->get($id);
            unset($usuario->contrasinal);
            $this->set(compact('usuario'));
            //$this->request->data = $this->Usuarios->findById($id);
            //unset($this->request->data['Usuarios']['password']);
        }
        $this->render('add');
    }

}
