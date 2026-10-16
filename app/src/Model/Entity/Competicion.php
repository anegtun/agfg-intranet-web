<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Competicion extends Entity {

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = array(
        '*' => true,
        'id' => false
    );

    public function isLiga() {
        return $this->tipo === 'liga';
    }

    public function isTorneo() {
        return $this->tipo === 'torneo';
    }

    public function isEliminatoria() {
        return $this->tipo === 'eliminatoria';
    }

    public function isTorneoOuEliminatoria() {
        return $this->isTorneo() || $this->isEliminatoria();
    }
}