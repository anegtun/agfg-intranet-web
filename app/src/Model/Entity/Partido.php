<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\ORM\Entity;

class Partido extends Entity {

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = array(
        '*' => true,
        'id' => false
    );

    protected $diasSemana = ['Dom','Lun','Mar','Mér','Xov','Ven','Sáb'];

    public function formatDataHora() {
        if(empty($this->data_partido)) {
            return NULL;
        }
        return $this->data_partido->format('Y-m-d').' '.$this->hora_partido;
    }

    public function formatDiaHora() {
        if(empty($this->hora_partido)) {
            return NULL;
        }
        return $this->diasSemana[$this->data_partido->format('w')].' '.$this->hora_partido;
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

    public function hasEquipa1() {
        return !empty($this->equipa1) || !empty($this->provisional_equipa1);
    }

    public function hasEquipa2() {
        return !empty($this->equipa2) || !empty($this->provisional_equipa2);
    }

    public function getNomeEquipa1() {
        return empty($this->equipa1) ? $this->provisional_equipa1 : $this->equipa1->nome;
    }

    public function getNomeEquipa2() {
        return empty($this->equipa2) ? $this->provisional_equipa2 : $this->equipa2->nome;
    }

    public function getNomeCurtoEquipa1() {
        return empty($this->equipa1) ? $this->provisional_equipa1 : $this->equipa1->nome_curto;
    }

    public function getNomeCurtoEquipa2() {
        return empty($this->equipa2) ? $this->provisional_equipa2 : $this->equipa2->nome_curto;
    }

    public function hasPuntuacionTotalEquipa1() {
        return $this->getPuntuacionTotalEquipa1() !== NULL;
    }

    public function hasPuntuacionTotalEquipa2() {
        return $this->getPuntuacionTotalEquipa2() !== NULL;
    }

    public function getPuntuacionTotalEquipa1() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa1, $this->tantos_equipa1, $this->total_equipa1);
    }

    public function getPuntuacionTotalEquipa2() {
        return $this->_calculatePuntuacionTotal($this->goles_equipa2, $this->tantos_equipa2, $this->total_equipa2);
    }

    public function hasDesglose() {
        return !is_null($this->goles_equipa1) || !is_null($this->goles_equipa2);
    }

    public function formatDesglose1() {
        return sprintf('%01d', $this->goles_equipa1)."-".sprintf('%02d', $this->tantos_equipa1);
    }

    public function formatDesglose2() {
        return sprintf('%01d', $this->goles_equipa2)."-".sprintf('%02d', $this->tantos_equipa2);
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

}