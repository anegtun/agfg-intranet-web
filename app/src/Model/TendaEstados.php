<?php
namespace App\Model;

class TendaEstados {
    
    public function getAll() {
        return [
            'N' => 'Novo',
            'PC' => 'Pendente cliente',
            'PP' => 'Pendente pedir',
            'PS' => 'Pendente stock',
            'PE' => 'Pendente envío',
            'NC' => 'Non contesta',
            'D' => 'Desistido',
            'SS' => 'Sen stock',
            'E' => 'Entregado'
        ];
    }
    
    public function getCodigosFinalizados() {
        return ['NC', 'D', 'SS', 'E'];
    }
}