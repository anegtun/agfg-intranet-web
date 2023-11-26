<?php
namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController {

    public function beforeFilter(EventInterface $event) {
        $this->Auth->allow(['login','logout']);
    }
    
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}