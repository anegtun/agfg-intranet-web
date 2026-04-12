<?php
namespace App\Model;

class ResumoEconomico {
    
    private $movementos;
    private $previsions;
    
    public function __construct($movementos, $previsions) {
        $this->movementos = $movementos;
        $this->previsions = $previsions;
    }

    public function getPartidasOrzanentarias() {
        $result = [];
        foreach($this->movementos as $e) {
            $result[$e->area->partidaOrzamentaria->id] = $e->area->partidaOrzamentaria;
        }
        foreach($this->previsions as $e) {
            $result[$e->area->partidaOrzamentaria->id] = $e->area->partidaOrzamentaria;
        }
        usort($result, ["self", "cmpNome"]);
        return $result;
    }

    public function getAreas($partidaOrzamentaria = null) {
        $result = [];
        foreach($this->movementos as $e) {
            if (empty($partidaOrzamentaria) || $e->area->partidaOrzamentaria->id === $partidaOrzamentaria->id) {
                $result[$e->area->id] = $e->area;
            }
        }
        foreach($this->previsions as $e) {
            if (empty($partidaOrzamentaria) || $e->area->partidaOrzamentaria->id === $partidaOrzamentaria->id) {
                $result[$e->area->id] = $e->area;
            }
        }
        usort($result, ["self", "cmpArea"]);
        return $result;
    }

    public function getConceptos($area) {
        $result = [];
        foreach($this->movementos as $e) {
            if ($e->area->id === $area->id) {
                $result[$e->descricion] = $e->descricion;
            }
        }
        foreach($this->previsions as $e) {
            if ($e->area->id === $area->id) {
                $result[$e->descricion] = $e->descricion;
            }
        }
        usort($result, ["self", "cmpConcepto"]);
        return $result;
    }

    public function getMovementosArea($prevision, $area) {
        return $this->filter($prevision, fn($e) => $e->area->id === $area->id);
    }

    public function getMovementosAreaConcepto($prevision, $area, $concepto) {
        return $this->filter($prevision, fn($e) => $e->area->id === $area->id && $e->descricion === $concepto);
    }

    public function getTotal() {
        return $this->sum(fn($e) => true);
    }

    public function getTotalPartidaOrzamentaria($partidaOrzamentaria) {
        return $this->sum(fn($e) => $e->area->partidaOrzamentaria->id === $partidaOrzamentaria->id);
    }

    public function getTotalArea($area) {
        return $this->sum(fn($e) => $e->area->id === $area->id);
    }

    public function getTotalAreaClube($area, $clube = NULL) {
        return $this->sum(fn($e) => $e->area->id === $area->id && !empty($e->id_clube) && (empty($clube) || $e->id_clube === $clube->id));
    }

    public function getTotalConcepto($area, $concepto) {
        return $this->sum(fn($e) => $e->area->id === $area->id && $e->descricion === $concepto);
    }

    private function filter($prevision, $filter) {
        $result = [];
        if (!$prevision) {
            foreach($this->movementos as $e) {
                if($filter($e)) {
                    $result[] = $e;
                }
            }
        }
        if ($prevision) {
            foreach($this->previsions as $e) {
                if($filter($e)) {
                    $result[] = $e;
                }
            }
        }
        return $result;
    }

    private function sum($filter) {
        $total = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'ingresos_previstos' => 0, 'gastos_previstos' => 0, 'balance_previsto' => 0];
        foreach($this->movementos as $e) {
            if($filter($e)) {
                $total->ingresos += $e->importe>0 ? $e->importe : 0;
                $total->gastos += $e->importe<0 ? $e->importe : 0;
                $total->comision += $e->comision;
                $total->balance += $e->importe + $e->comision;
            }
        }
        foreach($this->previsions as $e) {
            if($filter($e)) {
                $total->ingresos_previstos += $e->importe>0 ? $e->importe : 0;
                $total->gastos_previstos += $e->importe<0 ? $e->importe : 0;
                $total->balance_previsto += $e->importe;
            }
        }
        return $total;
    }

    private static function cmpArea($a, $b) {
        $cmp = strcmp($a->partidaOrzamentaria->nome, $b->partidaOrzamentaria->nome);
        if($cmp===0) {
            $cmp = strcmp($a->nome, $b->nome);
        }
        return $cmp;
    }

    private static function cmpNome($a, $b) {
        return strcmp($a->nome, $b->nome);
    }

    private static function cmpConcepto($a, $b) {
        return strcmp($a, $b);
    }

}