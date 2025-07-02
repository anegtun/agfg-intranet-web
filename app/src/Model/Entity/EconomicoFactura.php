<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class EconomicoFactura extends Entity {

    public function getImporteConComision() {
        return $this->importe + (empty($this->comision) ? 0 : $this->comision);
    }

    public function diffImporteMovementos() {
        $sumado = 0;
        
        if(!empty($this->movementos)) {
            foreach($this->movementos as $m) {
                $sumado += -$m->importe;
            }
        }

        return round($sumado - $this->importe, 2); 
    }

    public function isAberta() {
        return $this->estado === 'A';
    }

    public function isPechada() {
        return $this->estado === 'P';
    }

    public function isDescartada() {
        return $this->estado === 'D';
    }

}