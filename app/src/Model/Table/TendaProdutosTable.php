<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TendaProdutosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_tenda_produtos');

        $this->hasMany('Skus', array(
        	'className' => 'TendaProdutoSkus',
            'foreignKey' => 'id_produto',
            'propertyName' => 'skus'
        ));

        $this->hasMany('Prezos', array(
        	'className' => 'TendaProdutoPrezos',
            'foreignKey' => 'id_produto',
            'propertyName' => 'prezos',
            'sort' => ['data_inicio' => 'ASC']
        ));
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio');
    }
}