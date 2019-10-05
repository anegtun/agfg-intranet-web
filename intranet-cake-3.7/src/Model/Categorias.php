<?php
namespace App\Model;

class Categorias {
    
    public function getCategorias() {
        return [
            'F' => 'Feminina',
            'M' => 'Masculina'
        ];
    }

    public function getCategoria($key) {
        $cats = $this->getCategorias();
        return $cats[$key];
    }

}