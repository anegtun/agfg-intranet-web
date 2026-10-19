<?php
namespace App\Model;

class ClasificacionTorneo extends Clasificacion {

    private $_equipasFase;
    private $_equipasMap;
    private $_clasificacion = [];

    public function __construct($equipasFase, $equipasMap) {
        $this->_equipasFase = $equipasFase;
        $this->_equipasMap = $equipasMap;
    }

    public function getClasificacion() {
        return $this->_clasificacion;
    }

    public function getClasificacionEquipa($id) {
        foreach ($this->_clasificacion as $equipa) {
            if ((string)$equipa->id === (string)$id) {
                return $equipa;
            }
        }
        return NULL;
    }

    public function build($fase = NULL) {
        $equipas = [];

        foreach ($this->_equipasFase as $equipaFase) {
            if (!empty($fase) && (string)$equipaFase->id_fase !== (string)$fase->id) {
                continue;
            }
            if (empty($fase) && empty($equipaFase->fase->final)) {
                continue;
            }

            $idEquipa = $equipaFase->id_equipa;
            if (!isset($this->_equipasMap[$idEquipa])) {
                continue;
            }

            $posicion = empty($equipaFase->posicion) ? NULL : (int)$equipaFase->posicion;
            if (empty($fase)) {
                $idFase = $equipaFase->id_fase;
                if (!isset($equipas[$idEquipa])) {
                    $equipa = $this->_equipasMap[$idEquipa];
                    $clasificacionEquipa = ClasificacionLiga::init($idEquipa);
                    $clasificacionEquipa->codigo = $equipa->codigo;
                    $clasificacionEquipa->nome = $equipa->nome;
                    $clasificacionEquipa->nome_curto = $equipa->nome_curto;
                    $clasificacionEquipa->logo = $equipa->getLogo();
                    $clasificacionEquipa->posicionsFases = [];
                    $equipas[$idEquipa] = $clasificacionEquipa;
                }
                $equipas[$idEquipa]->posicionsFases[$idFase] = [
                    'prioridade' => (int)($equipaFase->fase->prioridade ?? 0),
                    'posicion' => $posicion
                ];
                continue;
            }

            if (!isset($equipas[$idEquipa])) {
                $equipa = $this->_equipasMap[$idEquipa];
                $clasificacionEquipa = ClasificacionLiga::init($idEquipa);
                $clasificacionEquipa->codigo = $equipa->codigo;
                $clasificacionEquipa->nome = $equipa->nome;
                $clasificacionEquipa->nome_curto = $equipa->nome_curto;
                $clasificacionEquipa->logo = $equipa->getLogo();
                $clasificacionEquipa->posicion = $posicion;
                $equipas[$idEquipa] = $clasificacionEquipa;
            }
        }

        if (empty($fase)) {
            $this->_buildClasificacionGlobal($equipas);
        } else {
            $this->_clasificacion = array_values($equipas);
        }

        usort($this->_clasificacion, function ($a, $b) {
            if ($a->posicion === NULL) {
                return $b->posicion === NULL ? $a->id <=> $b->id : 1;
            }
            if ($b->posicion === NULL) {
                return -1;
            }
            return ($a->posicion <=> $b->posicion) ?: ($a->id <=> $b->id);
        });
    }

    private function _buildClasificacionGlobal($equipas): void {
        $fases = [];
        foreach ($equipas as $equipa) {
            foreach ($equipa->posicionsFases as $idFase => $datosFase) {
                $fases[$idFase] = $datosFase;
            }
        }
        uasort($fases, function ($faseA, $faseB) {
            return $faseB['prioridade'] <=> $faseA['prioridade'];
        });

        $desprazamento = 0;
        $posicionsGlobais = [];
        foreach ($fases as $idFase => $datosFase) {
            $equipasFase = [];
            foreach ($equipas as $equipa) {
                if (isset($equipa->posicionsFases[$idFase])) {
                    $equipasFase[] = $equipa;
                }
            }

            foreach ($equipasFase as $equipa) {
                $posicionFase = $equipa->posicionsFases[$idFase]['posicion'];
                if ($posicionFase !== NULL) {
                    $posicionsGlobais[$equipa->id][] = $desprazamento + $posicionFase;
                }
            }
            $desprazamento += count($equipasFase);
        }

        $this->_clasificacion = array_values($equipas);
        foreach ($this->_clasificacion as $equipa) {
            $posicions = array_values(array_unique($posicionsGlobais[$equipa->id] ?? []));
            $equipa->posicion = count($posicions) === 1 ? $posicions[0] : NULL;
            unset($equipa->posicionsFases);
        }
    }
}
