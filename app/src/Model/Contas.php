<?php
namespace App\Model;

class Contas {
    
    public function getAll() {
        return array(
            'A' => 'ABanca',
            'B' => 'Bankinter',
            'E'  => 'Efectivo'
        );
    }
    
    public function getAllWithEmpty() {
        return array_merge([''=>''], $this->getAll());
    }

    public function get($key) {
        $all = $this->getAll();
        return $all[$key];
    }

}