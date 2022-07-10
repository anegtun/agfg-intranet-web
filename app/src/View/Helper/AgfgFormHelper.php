<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AgfgFormHelper extends Helper {
    
    public $helpers = ['Html'];
    
    public function editButton($url, $options = []) {
        $opts = array_merge($options, ['class'=>'glyphicon glyphicon-pencil']);
        return $this->Html->link('', $url, $opts);
    }
    
    public function deleteButton($url) {
        return $this->Html->link('', $url, ['class'=>'glyphicon glyphicon-trash', 'confirm'=>'Seguro que queres borrar o rexistro?']);
    }
    
    public function objectToKeyValue($array, $key, $value, $allowEmpty=true, $order=true) {
        $tmp = $allowEmpty ? [''=>''] : [];
        foreach($array as $e) {
            $v = '';
            // Asumimos que $value é unha propiedade do obxecto.
            // Senon é que é unha expresión complexa tipo '$e->nome $e->apelido'.
            if(isset($e->$value)) {
                $v = $e->$value;
            } else {
                eval("\$v = \"$value\";");
            }
            $tmp[$e->$key] = $v;
        }
        // Ordeamos por valor
        if($order) {
            asort($tmp);
        }
        return $tmp;
    }
    
}