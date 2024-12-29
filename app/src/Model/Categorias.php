<?php
namespace App\Model;

class Categorias {
    
    public function getCategorias() {
        return [
            'F' => 'Feminina',
            'M' => 'Masculina',
            'E' => 'Escolas'
        ];
    }
    
    public function getCategoriasFiltered($codes) {
        $all = $this->getCategorias();
        $res = [];
        foreach($codes as $c) {
            $res[$c] = $all[$c];
        }
        return $res;
    }
    
    public function getCategoriasWithEmpty() {
        return array_merge([''=>''], $this->getCategorias());
    }

    public function getCategoria($key) {
        $cats = $this->getCategorias();
        return $cats[$key];
    }

}