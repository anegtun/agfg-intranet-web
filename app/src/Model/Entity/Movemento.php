<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Movemento extends Entity {

    public function getImporteConComision() {
        return $this->importe + (empty($this->comision) ? 0 : $this->comision);
    }

}