<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FasesEquipasTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_fase_equipas');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_competicion', 'A competición é obrigatoria')
            ->notEmpty('id_equipa', 'A equipa é obrigatoria');
    }

}