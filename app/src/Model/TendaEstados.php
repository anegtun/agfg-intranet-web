<?php
namespace App\Model;

class TendaEstados {
    
    public function getAll() {
        return [
            'N' => 'Novo',
            'PC' => 'Pendente cliente',
            'PS' => 'Pendente stock',
            'PE' => 'Pendente envío',
            'NC' => 'Non contesta',
            'D' => 'Desistido',
            'E' => 'Entregado'
        ];
    }
    
    public function getCodigosFinalizados() {
        return ['NC', 'D', 'E'];
    }
}