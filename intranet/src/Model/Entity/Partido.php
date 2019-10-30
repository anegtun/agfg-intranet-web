<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18N\Time;
use Cake\ORM\Entity;

class Partido extends Entity {

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = array(
        '*' => true,
        'id' => false
    );

    public function formatDataHora() {
        if(empty($this->data_partido)) {
            return NULL;
        }
        return $this->data_partido->format('Y-m-d').' '.$this->hora_partido;
    }

    public function getDataHora() {
        if(empty($this->data_partido)) {
            return NULL;
        }
        $time = new Time($this->data_partido);
        if(!empty($this->hora_partido)) {
            $hour = explode(':',$this->hora_partido);
            $time->addHours($hour[0]);
            $time->addMinutes($hour[1]);
        }
        return $time;
    }

    public function getPuntuacionTotalEquipa1() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa1, $this->tantos_equipa1, $this->total_equipa1);
    }

    public function getPuntuacionTotalEquipa2() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa2, $this->tantos_equipa2, $this->total_equipa2);
    }

    public function formatPuntuacionEquipa1() {
        return $this->_formatPuntuacionTotal($this->goles_equipa1, $this->tantos_equipa1, $this->total_equipa1, $this->non_presentado_equipa1);
    }

    public function formatPuntuacionEquipa2() {
        return $this->_formatPuntuacionTotal($this->goles_equipa2, $this->tantos_equipa2, $this->total_equipa2, $this->non_presentado_equipa2);
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

    protected function _calculatePuntuacionTotal($goles, $tantos, $total) {
        if($goles===NULL && $tantos===NULL) {
            return $total;
        }
        $g = $goles===NULL ? 0 : $goles;
        $t = $tantos===NULL ? 0 : $tantos;
        return $g*3 + $t;
    }

    protected function _formatPuntuacionTotal($goles, $tantos, $total, $non_presentado) {
        if(!empty($non_presentado)) {
            return 'N.P.';
        }
        if($goles===NULL && $tantos===NULL) {
            if($total===NULL) {
                return NULL;
            }
            return '('.sprintf('%02d',$total).')';
        }
        $g = $goles===NULL ? 0 : $goles;
        $t = $tantos===NULL ? 0 : $tantos;
        $p = $this->_calculatePuntuacionTotal($goles, $tantos, NULL);
        return $g.'-'.sprintf('%02d',$t).' ('.sprintf('%02d',$p).')';
    }

}