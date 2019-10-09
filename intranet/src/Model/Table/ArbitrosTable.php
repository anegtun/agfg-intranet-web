<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArbitrosTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_arbitros');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('alcume', 'O alcume é obrigatorio');
    }

}