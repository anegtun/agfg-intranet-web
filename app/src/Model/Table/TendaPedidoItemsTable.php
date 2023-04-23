<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TendaPedidoItemsTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_tenda_pedido_items');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio');
    }
}