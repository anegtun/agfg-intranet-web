<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class TendaPedidoItem extends Entity {

    public function getPrezo() {
        $prezo = 0;
        foreach($this->sku->produto->prezos as $p) {
            if($this->pedido->data >= $p->data_inicio && $this->pedido->data <= $p->data_fin) {
                $prezo = $p->prezo;
                break;
            }
        }
        return $prezo * $this->cantidade;
    }

}