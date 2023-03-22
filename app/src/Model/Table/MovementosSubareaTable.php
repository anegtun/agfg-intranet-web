<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MovementosSubareaTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_movemento_subarea');
        
        $this->belongsTo('Area', [
        	'className' => 'MovementosArea',
            'foreignKey' => 'id_area',
            'propertyName' => 'area'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}