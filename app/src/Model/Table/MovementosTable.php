<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MovementosTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_movementos');
        $this->belongsTo('Subarea', [
        	'className' => 'MovementosSubarea',
            'foreignKey' => 'id_subarea',
            'propertyName' => 'subarea'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

}