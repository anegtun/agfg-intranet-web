<?php
namespace App\Model;

class EconomicoFacturaEstado {
    
    public function getAll() {
        return [
            'A' => 'Aberta',
            'P' => 'Pechada',
            'D' => 'Descartada'
        ];
    }
}