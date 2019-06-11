<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ClubesTable extends Table {

    public function initialize(array $config) {
        $this->table('agfg_clubes');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}