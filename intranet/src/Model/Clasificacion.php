<?php
namespace App\Model;

class Clasificacion {
    
    private $_equipas;
    private $_partidos;
    private $_clasificacion;
    
    public function __construct($equipas, $partidos) {
        $this->_equipas = $equipas;
        $this->_partidos = $partidos;
    }
    
    public function build() {
        $this->_clasificacion = [];
        foreach($this->_partidos as $p) {
            $this->_processGame($this->_clasificacion, $p);
        }
        // Ordeamos por puntos e asignamos posición
        usort($this->_clasificacion, function($a, $b) {
            return $b->puntos - $a->puntos;
        });
        $i = 1;
        foreach($this->_clasificacion as $e) {
            $e->posicion = $i++;
        }
    }

    /**
     * Desempata mirando enfrontamentos particulares
     */
    public function desempatar() {
        // Agrupamos equipos pola súa puntuación
        $agrupacionPuntos = [];
        foreach($this->_clasificacion as $e) {
            $agrupacionPuntos[$e->puntos][$e->id] = $e;
        }
    
        foreach($agrupacionPuntos as $puntosClasificacion=>$equipas) {
            // Miramos aqueles casos onde hai empate de puntos (>1 equipo)
            if(count($equipas)>1) {
                $idsEquipas = array_keys($equipas);
                // Facemos unha clasificación particular entre os afectados
                $clasificacionParticular = [];
                foreach($this->_partidos as $p) {
                    if(in_array($p->id_equipa1, $idsEquipas) && in_array($p->id_equipa2, $idsEquipas)) {
                        $this->_processGame($clasificacionParticular, $p);
                    }
                }
                // Ordeamos segundo estes criterios:
                // - Puntos en partidos particulares (ponderación 1.000.000 para que prevaleza sobre o resto de criterios)
                // - Diferenza de puntos particular (ponderación 1.000)
                // - Mellor diferenza puntos global
                usort($clasificacionParticular, function($a, $b) use($equipas) {
                    $globalA = $equipas[$a->id];
                    $globalB = $equipas[$b->id];
                    return
                        ($b->puntos - $a->puntos)*1000000 +
                        (($b->totalFavor-$b->totalContra) - ($a->totalFavor-$a->totalContra))*1000 + 
                        (($globalB->totalFavor-$globalB->totalContra) - ($globalA->totalFavor-$globalA->totalContra));
                   
                });
                // Buscamos a posición máxima onde están os equipos empatados, para reaxustar posición a partir de ahí
                $posicionMaxima = 1000;
                foreach($this->_clasificacion as $e) {
                    if($e->puntos === $puntosClasificacion && $e->posicion<$posicionMaxima) {
                        $posicionMaxima = $e->posicion;
                    }
                }
                // Recalculamos posición en base á orde da clasificación particular
                $offset = 0;
                foreach($clasificacionParticular as $ep) {
                    // array_values para forzar a reindexación, así sempre podemos coller de $result[0]
                    $e = array_values(array_filter($this->_clasificacion, function ($v) use($ep) {
                        return $v->id === $ep->id;
                    }));
                    $e[0]->posicion = $posicionMaxima + ($offset++);
                }
            }
        }

        // Ordeamos por puntos
        usort($this->_clasificacion, function($a, $b) {
            return $a->posicion - $b->posicion;
        });
    }

    private function _processGame(&$clsf, $partido) {
            if(empty($clsf[$partido->id_equipa1])) {
                $clsf[$partido->id_equipa1] = $this->_initClasificacion($partido->id_equipa1);
            }
            if(empty($clsf[$partido->id_equipa2])) {
                $clsf[$partido->id_equipa2] = $this->_initClasificacion($partido->id_equipa2);
            }
            $clsf[$partido->id_equipa1]->golesFavor += $partido->goles_equipa1;
            $clsf[$partido->id_equipa2]->golesFavor += $partido->goles_equipa2;
            $clsf[$partido->id_equipa1]->golesContra += $partido->goles_equipa2;
            $clsf[$partido->id_equipa2]->golesContra += $partido->goles_equipa1;
            $clsf[$partido->id_equipa1]->tantosFavor += $partido->tantos_equipa1;
            $clsf[$partido->id_equipa2]->tantosFavor += $partido->tantos_equipa2;
            $clsf[$partido->id_equipa1]->tantosContra += $partido->tantos_equipa2;
            $clsf[$partido->id_equipa2]->tantosContra += $partido->tantos_equipa1;
            $clsf[$partido->id_equipa1]->totalFavor += $partido->getPuntuacionTotalEquipa1();
            $clsf[$partido->id_equipa2]->totalFavor += $partido->getPuntuacionTotalEquipa2();
            $clsf[$partido->id_equipa1]->totalContra += $partido->getPuntuacionTotalEquipa2();
            $clsf[$partido->id_equipa2]->totalContra += $partido->getPuntuacionTotalEquipa1();
            $ganador = $partido->getGanador();
            if(!empty($ganador)) {
                $clsf[$partido->id_equipa1]->partidosXogados++;
                $clsf[$partido->id_equipa2]->partidosXogados++;
                if($ganador==='L') {
                    $clsf[$partido->id_equipa1]->puntos += 2;
                    $clsf[$partido->id_equipa1]->partidosGanados++;
                    $clsf[$partido->id_equipa2]->partidosPerdidos++;
                } elseif($ganador==='V') {
                    $clsf[$partido->id_equipa2]->puntos += 2;
                    $clsf[$partido->id_equipa1]->partidosPerdidos++;
                    $clsf[$partido->id_equipa2]->partidosGanados++;
                } elseif($ganador==='E') {
                    $clsf[$partido->id_equipa1]->puntos++;
                    $clsf[$partido->id_equipa2]->puntos++;
                    $clsf[$partido->id_equipa1]->partidosEmpatados++;
                    $clsf[$partido->id_equipa2]->partidosEmpatados++;
                }
            }
            return $clsf;
    }

    private function _initClasificacion($id) {
        return (object) [
            'id' => $this->_equipas[$id]->id,
            'codigo' => $this->_equipas[$id]->codigo,
            'nome' => $this->_equipas[$id]->nome,
            'logo' => $this->_equipas[$id]->logo,
            'posicion' => 0,
            'puntos' => 0,
            'partidosXogados' => 0,
            'partidosGanados' => 0,
            'partidosEmpatados' => 0,
            'partidosPerdidos' => 0,
            'golesFavor' => 0,
            'tantosFavor' => 0,
            'totalFavor' => 0,
            'golesContra' => 0,
            'tantosContra' => 0,
            'totalContra' => 0,
        ];
    }

    public function getClasificacion() {
        return $this->_clasificacion;
    }

}