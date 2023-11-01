<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class MovementosAreaTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_movemento_areas');

        $this->belongsTo('PartidaOrzamentaria', [
        	'className' => 'MovementosPartidaOrzamentaria',
            'foreignKey' => 'id_partida_orzamentaria',
            'propertyName' => 'partidaOrzamentaria'
        ]);

        $this->hasMany('Subareas', array(
        	'className' => 'MovementosSubarea',
            'foreignKey' => 'id_area',
            'propertyName' => 'subareas'
        ));
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}