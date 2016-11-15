<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompetitionPhaseTable extends Table {

    public function initialize(array $config) {
        $this->table('agfg_fase');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_competicion', 'A competición é obrigatoria')
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio');
    }

}