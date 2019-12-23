<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class AgfgConfigHelper extends Helper {
    
    public function version() {
        return Configure::read('agfg.version');
    }
    
}