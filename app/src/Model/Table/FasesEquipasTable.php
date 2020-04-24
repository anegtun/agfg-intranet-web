<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FasesEquipasTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_fase_equipas');
        $this->belongsTo('Fases', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase é obrigatoria')
            ->notEmpty('id_equipa', 'A equipa é obrigatoria');
    }

}