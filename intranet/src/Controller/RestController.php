<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class RestController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow();
    }
    
}
