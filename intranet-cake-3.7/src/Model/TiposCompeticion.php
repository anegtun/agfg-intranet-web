<?php
namespace App\Model;

class TiposCompeticion {
    
    public function getTipos() {
        return [
            'liga-normal'  => 'Liga normal',
            'liga-partida' => 'Liga volta partida',
            'copa-longa'   => 'Copa longa',
            'iberico'      => 'Copa tipo ibérico'
        ];
    }

    public function getTipo($key) {
        $tipos = $this->getTipos();
        return $tipos[$key];
    }

}