<?php
namespace App\Model;

class EventosTipo {
    
    public function getAll() {
        return [
            'CL' => 'Competicion clubes',
            'FO' => 'Formación',
            'SE' => 'Selección',
            'OU' => 'Outros'
        ];
    }
    
    public function getAllWithEmpty() {
        return array_merge([''=>''], $this->getAll());
    }
}