<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class TendaPedido extends Entity {

    public function getTotal() {
        if(!empty($this->prezo)) {
            return $this->prezo;
        }

        $total = 0;
        foreach($this->items as $item) {
            $total += $item->getPrezo() + $item->prezo_extra;
        }
        return $total;
    }
}