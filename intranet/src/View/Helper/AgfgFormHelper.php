<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AgfgFormHelper extends Helper {
    
    public $helpers = ['Html'];
    
    public function editButton($url) {
        return $this->Html->link('', $url, ['class'=>'glyphicon glyphicon-pencil']);
    }
    
    public function deleteButton($url) {
        return $this->Html->link('', $url, ['class'=>'glyphicon glyphicon-trash', 'confirm'=>'Seguro que queres borrar o rexistro?']);
    }
    
    public function objectToKeyValue($array, $key, $value, $allowEmpty=true) {
        $tmp = $allowEmpty ? [''=>''] : [];
        foreach($array as $e) {
            $tmp[$e->$key] = $e->$value;
        }
        return $tmp;
    }
    
}