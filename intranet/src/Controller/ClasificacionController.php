<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ClasificacionController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index']);

        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index($uuid) {
        $competicion = $this->Competicions->find()->where(['Competicions.uuid'=>$uuid])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        
        $equipas = $this->Equipas->findMap();

        $partidos = $this->Partidos
            ->find()
            ->join(['table'=>'agfg_xornada', 'alias'=>'Xornadas', 'conditions'=>['Xornadas.id = Partidos.id_xornada']])
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Xornadas.id_fase']])
            ->where(['Fases.id_competicion'=>$competicion->id]);

        $clasificacion = [];
        foreach($partidos as $p) {
            if(empty($clasificacion[$p->id_equipa1])) {
                $clasificacion[$p->id_equipa1] = $this->_initClasificacion($equipas, $p->id_equipa1);
            }
            if(empty($clasificacion[$p->id_equipa2])) {
                $clasificacion[$p->id_equipa2] = $this->_initClasificacion($equipas, $p->id_equipa2);
            }
            $clasificacion[$p->id_equipa1]->golesF += $p->goles_equipa1;
            $clasificacion[$p->id_equipa2]->golesF += $p->goles_equipa2;
            $clasificacion[$p->id_equipa1]->golesC += $p->goles_equipa2;
            $clasificacion[$p->id_equipa2]->golesC += $p->goles_equipa1;
            $clasificacion[$p->id_equipa1]->tantosF += $p->tantos_equipa1;
            $clasificacion[$p->id_equipa2]->tantosF += $p->tantos_equipa2;
            $clasificacion[$p->id_equipa1]->tantosC += $p->tantos_equipa2;
            $clasificacion[$p->id_equipa2]->tantosC += $p->tantos_equipa1;
            $clasificacion[$p->id_equipa1]->totalF += $p->getPuntuacionTotalEquipa1();
            $clasificacion[$p->id_equipa2]->totalF += $p->getPuntuacionTotalEquipa2();
            $clasificacion[$p->id_equipa1]->totalC += $p->getPuntuacionTotalEquipa2();
            $clasificacion[$p->id_equipa2]->totalC += $p->getPuntuacionTotalEquipa1();
            $ganador = $p->getGanador();
            if($ganador==='L') {
                $clasificacion[$p->id_equipa1]->puntos += 2;
            } elseif($ganador==='V') {
                $clasificacion[$p->id_equipa2]->puntos += 2;
            } elseif($ganador==='E') {
                $clasificacion[$p->id_equipa1]->puntos++;
                $clasificacion[$p->id_equipa2]->puntos++;
            }
        }
        $clasificacion = $this->_sortClasificacion($clasificacion, $partidos);
        $this->set($clasificacion);
    }

    private function _sortClasificacion($clasificacion, $partidos) {
        // Ordeamos por puntos
        usort($clasificacion, function($a, $b) {
            return $b->puntos - $a->puntos;
        });
        $i = 1;
        foreach($clasificacion as $e) {
            $e->posicion = $i++;
        }
        //Miramos enfrontamentos particulares
        $puntos = [];
        foreach($clasificacion as $e) {
            $puntos[$e->puntos][$e->id] = $e;
        }

        foreach($puntos as $numPuntos=>$pu) {
            if(count($pu)>1) {
                $idsEquipas = array_keys($pu);
                $puntosParticular = [];
                foreach($partidos as $p) {
                    if(in_array($p->id_equipa1, $idsEquipas) && in_array($p->id_equipa2, $idsEquipas)) {
                        if(empty($puntosParticular[$p->id_equipa1])) {
                            $puntosParticular[$p->id_equipa1] = 0;
                        }
                        if(empty($puntosParticular[$p->id_equipa2])) {
                            $puntosParticular[$p->id_equipa2] = 0;
                        }
                        $ganador = $p->getGanador();
                        if($ganador==='L') {
                            $puntosParticular[$p->id_equipa1] += 2;
                        } elseif($ganador==='V') {
                            $puntosParticular[$p->id_equipa2] += 2;
                        } elseif($ganador==='E') {
                            $puntosParticular[$p->id_equipa1]++;
                            $puntosParticular[$p->id_equipa2]++;
                        }
                    }
                }
                // Ordeamos
                arsort($puntosParticular);
                print_r($puntosParticular);
                $posicionMaxima = 100;
                foreach($clasificacion as $e) {
                    if($e->puntos === $numPuntos && $e->posicion<$posicionMaxima) {
                        $posicionMaxima = $e->posicion;
                    }
                }
                foreach($clasificacion as $e) {
                    if($e->puntos === $numPuntos && $e->posicion<$posicionMaxima) {
                        $posicionMaxima = $e->posicion;
                    }
                }
                // TODO
            }
        }
        return $clasificacion;
    }

    private function _initClasificacion($equipas, $id) {
        return (object) [
            'id' => $equipas[$id]->id,
            'codigo' => $equipas[$id]->codigo,
            'nome' => $equipas[$id]->nome,
            'logo' => $equipas[$id]->logo,
            'posicion' => 0,
            'puntos' => 0,
            'golesF' => 0,
            'tantosF' => 0,
            'totalF' => 0,
            'golesC' => 0,
            'tantosC' => 0,
            'totalC' => 0,
        ];
    }
    
}
