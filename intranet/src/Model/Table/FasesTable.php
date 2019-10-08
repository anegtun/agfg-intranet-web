<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FasesTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_fase');
        /*$this->belongsTo('Competicions', [
        	'className' => 'Competicions',
            'foreignKey' => 'id_competicion',
            'propertyName' => 'competicion'
        ]);*/
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_competicion', 'A competición é obrigatoria')
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio');
    }

}