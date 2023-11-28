<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoMovementosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_movementos');

        $this->belongsTo('Subarea', [
        	'className' => 'EconomicoSubareas',
            'foreignKey' => 'id_subarea',
            'propertyName' => 'subarea'
        ]);

        $this->belongsTo('Clube', [
        	'className' => 'Clubes',
            'foreignKey' => 'id_clube',
            'propertyName' => 'clube'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

}