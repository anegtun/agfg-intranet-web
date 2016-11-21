<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class MainController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['index','login','logout']);
    }



    public function index() {
    	// Vacio
    }
    
    

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            print_r($user);
            die();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}