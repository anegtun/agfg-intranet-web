<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TendaPedidosTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_tenda_pedidos');
       
        $this->hasMany('Items', array(
        	'className' => 'TendaPedidoItems',
            'foreignKey' => 'id_pedido',
            'propertyName' => 'items'
        ));
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('data', 'A data é obrigatoria');
    }
}