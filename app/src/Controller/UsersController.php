<?php
namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController {

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login','logout']);
    }
    
    public function login() {
        $user = $this->Authentication->getResult();
        if ($user->isValid()) {
            return $this->redirect(['controller'=>'Main', 'action'=>'index']);
        }

        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function logout() {
        $this->Authentication->logout();
        return $this->redirect(['action'=>'login']);
    }

}