<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class XornadasTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_xornada');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase é obrigatoria')
            ->notEmpty('data', 'A data é obrigatoria')
            ->notEmpty('numero', 'O número de xornada é obrigatorio');
    }

}