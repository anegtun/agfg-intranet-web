<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TendaProdutoSkusTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_tenda_produto_skus');

        $this->belongsTo('Produto', [
        	'className' => 'TendaProdutos',
            'foreignKey' => 'id_produto',
            'propertyName' => 'produto'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio');
    }
}