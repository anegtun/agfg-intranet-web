<?php
namespace App\Model;

class TiposFase {

    public const CLASIFICATORIO = 'C';
    public const FINAL = 'F';

    public function getTipos() {
        return [
            self::CLASIFICATORIO => 'Clasificatorio',
            self::FINAL => 'Final'
        ];
    }

    public function getTiposWithEmpty() {
        return array_merge(['' => ''], $this->getTipos());
    }

    public function getTipo($key) {
        $tipos = $this->getTipos();
        return $tipos[$key];
    }
}
