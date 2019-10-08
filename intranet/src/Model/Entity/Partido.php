<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Partido extends Entity {

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = array(
        '*' => true,
        'id' => false
    );

    public function getPuntuacionTotalEquipa1() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa1, $this->tantos_equipa1);
    }

    public function getPuntuacionTotalEquipa2() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa2, $this->tantos_equipa2);
    }

    public function getGanador() {
        $puntuacion1 = $this->getPuntuacionTotalEquipa1();
        $puntuacion2 = $this->getPuntuacionTotalEquipa2();
        if($puntuacion1===NULL && $puntuacion2===NULL) {
            return NULL;
        }
        if($puntuacion1===$puntuacion2) {
            return 'E';
        }
        if($puntuacion1>$puntuacion2) {
            return 'L';
        }
        if($puntuacion1<$puntuacion2) {
            return 'V';
        }
    }

    protected function _calculatePuntuacionTotal($goles, $tantos) {
        if($goles===NULL && $tantos===NULL) {
            return NULL;
        }
        $g = $goles===NULL ? 0 : $goles;
        $t = $tantos===NULL ? 0 : $tantos;
        return $g*3 + $t;
    }

}