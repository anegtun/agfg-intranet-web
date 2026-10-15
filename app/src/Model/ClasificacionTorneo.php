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

            $idEquipa = $equipaFase->id_equipa;
            if (!isset($this->_equipasMap[$idEquipa])) {
                continue;
            }

            if (!isset($equipas[$idEquipa])) {
                $equipa = $this->_equipasMap[$idEquipa];
                $clasificacionEquipa = ClasificacionLiga::init($idEquipa);
                $clasificacionEquipa->codigo = $equipa->codigo;
                $clasificacionEquipa->nome = $equipa->nome;
                $clasificacionEquipa->nome_curto = $equipa->nome_curto;
                $clasificacionEquipa->logo = $equipa->getLogo();
                $clasificacionEquipa->posicion = empty($equipaFase->posicion) ? NULL : (int)$equipaFase->posicion;
                $equipas[$idEquipa] = $clasificacionEquipa;
            } elseif (empty($equipas[$idEquipa]->posicion) && !empty($equipaFase->posicion)) {
                $equipas[$idEquipa]->posicion = (int)$equipaFase->posicion;
            }
        }

        $this->_clasificacion = array_values($equipas);
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
}
