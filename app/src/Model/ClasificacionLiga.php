<?php
namespace App\Model;

class ClasificacionLiga extends Clasificacion {

    private $_partidos;
    private $_equipasFase;
    private $_equipasMap;
    private $_clasificacion;

    public function __construct($partidos, $equipasFase, $equipasMap) {
        $this->_partidos = $partidos;
        $this->_equipasFase = $equipasFase;
        $this->_equipasMap = $equipasMap;
    }

    public function getClasificacion() {
        return $this->_clasificacion;
    }

    public function getClasificacionEquipa($id) {
        foreach($this->_clasificacion as $e) {
            if($e->id === $id) {
                return $e;
            }
        }
        return NULL;
    }

    public function build($fase = NULL) {
        $this->_clasificacion = [];
        $soFasesFinais = $fase === NULL;

        if (empty($fase) && !$this->_tenClasificacionGlobal($soFasesFinais)) {
            return;
        }

        $partidos = array_filter($this->_partidos, function ($p) use ($fase, $soFasesFinais) {
            if(!empty($fase)) {
                return $p->id_fase === $fase->id;
            }
            return !$soFasesFinais || !empty($p->fase->final);
        });
        foreach($partidos as $p) {
            $this->_procesarPartido($this->_clasificacion, $p);
        }

        $this->_sort();

        if(!empty($fase) && !empty($fase->id_fase_pai) && !empty($fase->acarrear_puntos)) {
            $partidos_pai = array_filter($this->_partidos, function ($p) use ($fase) { return $p->id_fase === $fase->id_fase_pai; });
            $clasificacionPai = new ClasificacionLiga($partidos_pai, $this->_equipasFase, $this->_equipasMap);
            $clasificacionPai->build((object)['id' => $fase->id_fase_pai]);
            $this->_addData($clasificacionPai->getClasificacion());
        }

        $equipasFase = $this->_equipasFase;
        if(!empty($fase)) {
            $equipasFase = [];
            foreach($this->_equipasFase as $ef) {
                if($ef->id_fase === $fase->id) {
                    $equipasFase[] = $ef;
                }
            }
        } elseif($soFasesFinais) {
            $equipasFase = array_filter($equipasFase, function ($ef) {
                return !empty($ef->fase->final);
            });
        }

        $equipasPuntos = [];
        foreach($equipasFase as $fe) {
            if(empty($equipasPuntos[$fe->id_equipa])) {
                $equipasPuntos[$fe->id_equipa] = self::init($fe->id_equipa);
            }
            if(!empty($fe->puntos)) {
                $equipasPuntos[$fe->id_equipa]->puntos_sen_sancion += $fe->puntos;
            }
        }

        $this->_addData(array_values($equipasPuntos));

        $posicionsManuais = $this->_posicionsManuais($equipasFase);
        if($posicionsManuais !== null) {
            foreach($this->_clasificacion as $equipa) {
                $equipa->posicion = $posicionsManuais[(string)$equipa->id];
            }
            usort($this->_clasificacion, function($a, $b) {
                return ($a->posicion <=> $b->posicion) ?: ($a->id <=> $b->id);
            });
        }
    }

    private function _posicionsManuais($equipasFase) {
        $posicions = [];
        foreach($equipasFase as $equipaFase) {
            if(empty($equipaFase->posicion)) {
                continue;
            }

            $idEquipa = (string)$equipaFase->id_equipa;
            $posicion = (int)$equipaFase->posicion;
            if(isset($posicions[$idEquipa]) && $posicions[$idEquipa] !== $posicion) {
                return null;
            }
            $posicions[$idEquipa] = $posicion;
        }

        foreach($this->_clasificacion as $equipa) {
            if(!isset($posicions[(string)$equipa->id])) {
                return null;
            }
        }

        return $posicions ?: null;
    }

    private function _tenClasificacionGlobal($soFasesFinais = false) {
        $id_equipas = $equipas_fase = [];

        foreach ($this->_equipasFase as $ef) {
            if($soFasesFinais && empty($ef->fase->final)) {
                continue;
            }
            $id_equipas[] = $ef->id_equipa;
            $id_equipas = array_unique($id_equipas);
            
            if(empty($equipas_fase[$ef->fase->id])) {
                $equipas_fase[$ef->fase->id] = [];
            }
            $equipas_fase[$ef->fase->id][] = $ef->id_equipa;
            $equipas_fase[$ef->fase->id] = array_unique($equipas_fase[$ef->fase->id]);
        }

        foreach ($equipas_fase as $fase=>$equipas) {
            if (count($equipas) === count($id_equipas)) {
                return true;
            }
        }

        return false;
    }

    private function _addData($clsfAnterior) {
        for($i=0; $i<count($this->_clasificacion); $i++) {
            for($j=0; $j<count($clsfAnterior); $j++) {
                if($this->_clasificacion[$i]->id===$clsfAnterior[$j]->id) {
                    $this->_addTeamData($this->_clasificacion[$i], $clsfAnterior[$j]);
                }
            }
        }
        $this->_sort();
    }
    
    private function _sort() {
        // Calculamos puntos a partir de sancións (non pode baixar de 0)
        foreach($this->_clasificacion as $e) {
            $e->puntos = $e->puntos_sen_sancion - $e->puntos_sancion;
            if($e->puntos < 0) {
                $e->puntos = 0;
            }
        }
        // Ordeamos por puntos e asignamos posición
        usort($this->_clasificacion, function($a, $b) {
            return $b->puntos - $a->puntos;
        });
        $i = 1;
        foreach($this->_clasificacion as $e) {
            $e->posicion = $i++;
        }
        // Lóxica de desempate
        $this->_desempatar();
    }

    /**
     * Desempata mirando enfrontamentos particulares
     */
    private function _desempatar() {
        // Agrupamos equipos pola súa puntuación
        $agrupacionPuntos = [];
        foreach($this->_clasificacion as $e) {
            $agrupacionPuntos[$e->puntos][$e->id] = $e;
        }

        foreach($agrupacionPuntos as $puntosClasificacion=>$equipas) {
            // Miramos aqueles casos onde hai empate de puntos (>1 equipo)
            if(count($equipas)>1) {
                // Facemos unha clasificación particular entre os afectados
                $clasificacionParticular = [];
                foreach($equipas as $idEquipa => $_) {
                    $clasificacionParticular[$idEquipa] = $this->_initClasificacion($idEquipa);
                }
                foreach($this->_partidos as $p) {
                    if(isset($clasificacionParticular[$p->id_equipa1], $clasificacionParticular[$p->id_equipa2])) {
                        $this->_procesarPartido($clasificacionParticular, $p);
                    }
                }
                foreach($clasificacionParticular as $equipa) {
                    $equipa->puntos = max(0, $equipa->puntos_sen_sancion - $equipa->puntos_sancion);
                }
                $clasificacionParticular = array_values($clasificacionParticular);
                usort($clasificacionParticular, function($a, $b) use($equipas) {
                    $comparacionPuntos = $b->puntos <=> $a->puntos;
                    if($comparacionPuntos !== 0) {
                        return $comparacionPuntos;
                    }

                    $diferenzaDirectaA = $a->totalFavor - $a->totalContra;
                    $diferenzaDirectaB = $b->totalFavor - $b->totalContra;
                    $comparacionDiferenzaDirecta = $diferenzaDirectaB <=> $diferenzaDirectaA;
                    if($comparacionDiferenzaDirecta !== 0) {
                        return $comparacionDiferenzaDirecta;
                    }

                    $diferenzaGlobalA = $equipas[$a->id]->totalFavor - $equipas[$a->id]->totalContra;
                    $diferenzaGlobalB = $equipas[$b->id]->totalFavor - $equipas[$b->id]->totalContra;
                    return $diferenzaGlobalB <=> $diferenzaGlobalA;
                });
                // Calculamos as posicións usando os tres criterios de desempate.
                $posicionBase = min(array_map(function($equipa) {
                    return $equipa->posicion;
                }, $equipas));
                // Recalculamos posición en base á orde da clasificación particular
                $posicion = $posicionBase;
                $metricasAnteriores = null;
                foreach($clasificacionParticular as $indice => $equipa) {
                    $metricas = [
                        $equipa->puntos,
                        $equipa->totalFavor - $equipa->totalContra,
                        $equipas[$equipa->id]->totalFavor - $equipas[$equipa->id]->totalContra
                    ];
                    if($metricasAnteriores !== null && $metricas !== $metricasAnteriores) {
                        $posicion = $posicionBase + $indice;
                    }
                    $equipas[$equipa->id]->posicion = $posicion;
                    $metricasAnteriores = $metricas;
                }
            }
        }

        // Ordeamos por puntos
        usort($this->_clasificacion, function($a, $b) {
            return $a->posicion - $b->posicion;
        });
    }

    private function _procesarPartido(&$clsf, $partido) {
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
                $clsf[$partido->id_equipa1]->puntos_sen_sancion += 2;
                $clsf[$partido->id_equipa1]->partidosGanados++;
                $clsf[$partido->id_equipa2]->partidosPerdidos++;
            } elseif($ganador==='V') {
                $clsf[$partido->id_equipa2]->puntos_sen_sancion += 2;
                $clsf[$partido->id_equipa1]->partidosPerdidos++;
                $clsf[$partido->id_equipa2]->partidosGanados++;
            } elseif($ganador==='E') {
                $clsf[$partido->id_equipa1]->puntos_sen_sancion++;
                $clsf[$partido->id_equipa2]->puntos_sen_sancion++;
                $clsf[$partido->id_equipa1]->partidosEmpatados++;
                $clsf[$partido->id_equipa2]->partidosEmpatados++;
            }
        }
        // Puntos de sanción por partido
        if(!empty($partido->sancion_puntos_equipa1)) {
            $clsf[$partido->id_equipa1]->puntos_sancion += $partido->sancion_puntos_equipa1;
        }
        if(!empty($partido->sancion_puntos_equipa2)) {
            $clsf[$partido->id_equipa2]->puntos_sancion += $partido->sancion_puntos_equipa2;
        }
        return $clsf;
    }

    private function _addTeamData(&$target, $source) {
        $target->golesFavor += $source->golesFavor;
        $target->golesContra += $source->golesContra;
        $target->tantosFavor += $source->tantosFavor;
        $target->tantosContra += $source->tantosContra;
        $target->totalFavor += $source->totalFavor;
        $target->totalContra += $source->totalContra;
        $target->partidosXogados += $source->partidosXogados;
        $target->partidosGanados += $source->partidosGanados;
        $target->partidosEmpatados += $source->partidosEmpatados;
        $target->partidosPerdidos += $source->partidosPerdidos;
        $target->puntos_sen_sancion += $source->puntos_sen_sancion;
        $target->puntos_sancion += $source->puntos_sancion;
    }

    private function _initClasificacion($id) {
        return (object) [
            'id' => $this->_equipasMap[$id]->id,
            'codigo' => $this->_equipasMap[$id]->codigo,
            'nome' => $this->_equipasMap[$id]->nome,
            'nome_curto' => $this->_equipasMap[$id]->nome_curto,
            'logo' => $this->_equipasMap[$id]->getLogo(),
            'posicion' => 0,
            'puntos' => 0,
            'puntos_sen_sancion' => 0,
            'puntos_sancion' => 0,
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

    public static function init($id) {
        return (object) [
            'id' => $id,
            'posicion' => 0,
            'puntos' => 0,
            'puntos_sen_sancion' => 0,
            'puntos_sancion' => 0,
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

}