<?php
namespace App\Model;

abstract class Clasificacion {

    public static function create($competicion, $partidos, $equipasFase, $equipasMap) {
        if ($competicion->isLiga()) {
            return new ClasificacionLiga($partidos, $equipasFase, $equipasMap);
        }
        return new ClasificacionBaleira();
    }

    abstract public function getClasificacion();

    abstract public function getClasificacionEquipo($codigo);
    
    abstract public function build($fase = NULL);
}