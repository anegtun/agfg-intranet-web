<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Equipa extends Entity {

    public function getLogo() {
        if(!empty($this->logo)) {
            return $this->logo;
        }
        if(!empty($this->clube) && !empty($this->clube->logo)) {
            return $this->clube->logo;
        }
        return NULL;
    }

}