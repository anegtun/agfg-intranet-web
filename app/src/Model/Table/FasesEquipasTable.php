<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class FasesEquipasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_fase_equipas');
        $this->belongsTo('Fases', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('id_fase', 'A fase é obrigatoria')
            ->notEmpty('id_equipa', 'A equipa é obrigatoria');
    }

}