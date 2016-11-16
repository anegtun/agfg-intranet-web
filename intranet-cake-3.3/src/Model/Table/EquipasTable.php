<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EquipasTable extends Table {

    public function initialize(array $config) {
        $this->table('agfg_equipas');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}