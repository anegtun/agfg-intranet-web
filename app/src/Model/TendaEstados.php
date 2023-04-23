<?php
namespace App\Model;

class TendaEstados {
    
    public function getAll() {
        return array(
            'N' => 'Novo',
            'PS' => 'Pendente stock',
            'PE' => 'Pendente envío',
            'NC' => 'Non contesta',
            'D' => 'Desistido',
            'E' => 'Entregado'
        );
    }
    
    public function getCodigosFinalizados() {
        return ['NC', 'D', 'E'];
    }
}