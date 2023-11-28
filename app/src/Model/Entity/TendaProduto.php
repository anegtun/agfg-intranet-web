<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class TendaProduto extends Entity {

    public function getStockTotal() {
        $stock = 0;
        foreach($this->skus as $s) {
            $stock += $s->stock;
        }
        return $stock;
    }

}