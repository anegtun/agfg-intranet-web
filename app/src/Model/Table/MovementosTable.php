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
        $this->belongsTo('Clube', [
        	'className' => 'Clubes',
            'foreignKey' => 'id_clube',
            'propertyName' => 'clube'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

}