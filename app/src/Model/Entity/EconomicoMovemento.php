<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class EconomicoMovemento extends Entity {

    public function getImporteConComision() {
        return $this->importe + (empty($this->comision) ? 0 : $this->comision);
    }

}