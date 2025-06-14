<?php
namespace App\Model;

class EventosTipo {

    const CLUBES = ['codigo' => 'CL', 'descricion' => 'Competicion clubes'];
    const GAELICO_ESCOLAS = ['codigo' => 'GE', 'descricion' => 'Gaélico Escolas'];
    const SELECCION = ['codigo' => 'SE', 'descricion' => 'Selección'];

    public function getAll() {
        return [
            'CL' => 'Competicion clubes',
            'FO' => 'Formación',
            'GE' => 'Gaélico Escolas',
            'SE' => 'Selección',
            'OU' => 'Outros'
        ];
    }
    
    public function getAllWithEmpty() {
        return array_merge([''=>''], $this->getAll());
    }
}