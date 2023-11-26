<?php
namespace App\Controller;

use Cake\Event\EventInterface;

class MainController extends AppController {

    public function beforeFilter(EventInterface $event) {
        $this->Auth->allow(['index']);
    }

    public function index() {
        if(!$this->Auth->user()) {
            return $this->redirect(['controller'=>'users', 'action'=>'login']);
        }
    }
}