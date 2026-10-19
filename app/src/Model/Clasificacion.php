<?php
namespace App\Model;

abstract class Clasificacion {

    public static function create($competicion, $partidos, $equipasFase, $equipasMap, $fase = null) {
        if ($competicion->isLiga() || (!empty($fase) && $fase->formato === FormatosFase::LIGA)) {
            return new ClasificacionLiga($partidos, $equipasFase, $equipasMap);
        }
        if ($competicion->isTorneoOuEliminatoria()) {
            return new ClasificacionTorneo($equipasFase, $equipasMap);
        }
        return new ClasificacionBaleira();
    }

    abstract public function getClasificacion();

    abstract public function getClasificacionEquipa($codigo);
    
    abstract public function build($fase = NULL);
}