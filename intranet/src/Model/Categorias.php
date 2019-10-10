<?php
namespace App\Model;

class Categorias {
    
    public function getCategorias() {
        return array(
            'F' => 'Feminina',
            'M' => 'Masculina'
        );
    }
    
    public function getCategoriasWithEmpty() {
        return array_merge([''=>''], $this->getCategorias());
    }

    public function getCategoria($key) {
        $cats = $this->getCategorias();
        return $cats[$key];
    }

}