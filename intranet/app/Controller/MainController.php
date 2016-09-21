<?php
App::uses('AppController', 'Controller');

class MainController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow('index');
    }



    public function index() {
    	// Vacio
    }

}