<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MovementosAreaTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_movemento_areas');
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}