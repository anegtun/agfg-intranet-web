<?php
namespace App\Model;

class TiposCompeticion {
    
    public function getTipos() {
        return array(
            'liga' => 'Liga',
            'eliminatoria' => 'Eliminatoria',
            'torneo'  => 'Torneo 1 día'
        );
    }
    
    public function getTiposWithEmpty() {
        return array_merge([''=>''], $this->getTipos());
    }

    public function getTipo($key) {
        $tipos = $this->getTipos();
        return $tipos[$key];
    }

}