<?php
namespace App\Model;

class TendaTipoEnvio {
    
    public function getAll() {
        return array(
            'M' => 'Entrega en man',
            'O' => 'Ordinario',
            'C' => 'Certificado',
            'R' => 'Contrareembolso',
            'I' => 'Internacional'
        );
    }
}