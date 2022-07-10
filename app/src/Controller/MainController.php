<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class MainController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(array('index','login','logout'));
    }

    public function index() {
        if(!$this->Auth->user()) {
            return $this->redirect(array('action'=>'login'));
        }
    }
}