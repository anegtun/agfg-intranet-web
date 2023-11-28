<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class CompeticionEquipasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->table('agfg_competicion_equipas');
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio')
            ->notEmpty('ano', 'O ano é obrigatorio');
    }

}