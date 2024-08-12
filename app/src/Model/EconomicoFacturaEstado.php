<?php
namespace App\Model;

class EconomicoFacturaEstado {
    
    public function getAll() {
        return [
            'P' => 'Pendente',
            'F' => 'Finalizada'
        ];
    }
}