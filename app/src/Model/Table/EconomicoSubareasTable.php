<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoSubareasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_subarea');
        
        $this->belongsTo('Area', [
        	'className' => 'EconomicoAreas',
            'foreignKey' => 'id_area',
            'propertyName' => 'area'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}