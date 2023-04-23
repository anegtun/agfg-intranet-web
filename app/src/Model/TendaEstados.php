<?php
namespace App\Model;

class TendaEstados {
    
    public function getAll() {
        return array(
            'N' => 'Novo',
            'PS' => 'Pendente stock',
            'PE' => 'Pendente envío',
            'D' => 'Desistido',
            'F' => 'Finalizado'
        );
    }
    
    public function getCodigosFinalizados() {
        return ['D', 'F'];
    }
}