<?php
namespace App\Model;

class TiposCompeticion {
    
    public function getTipos() {
        return [
            'liga' => 'Liga',
            'eliminatoria' => 'Eliminatoria',
            'torneo'  => 'Torneo 1 día'
        ];
    }

    public function getTipo($key) {
        $tipos = $this->getTipos();
        return $tipos[$key];
    }

}