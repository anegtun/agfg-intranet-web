<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CamposTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_campos');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('pobo', 'O pobo é obrigatorio');
    }

}