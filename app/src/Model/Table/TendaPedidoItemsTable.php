<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TendaPedidoItemsTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_tenda_pedido_items');

        $this->belongsTo('Pedido', [
        	'className' => 'TendaPedidos',
            'foreignKey' => 'id_pedido',
            'propertyName' => 'pedido'
        ]);

        $this->belongsTo('Sku', [
        	'className' => 'TendaProdutoSkus',
            'foreignKey' => 'id_sku',
            'propertyName' => 'sku'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio');
    }
}