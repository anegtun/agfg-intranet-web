<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoAreasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_areas');

        $this->belongsTo('PartidaOrzamentaria', [
        	'className' => 'EconomicoPartidasOrzamentarias',
            'foreignKey' => 'id_partida_orzamentaria',
            'propertyName' => 'partidaOrzamentaria'
        ]);

        $this->hasMany('Subareas', array(
        	'className' => 'EconomicoSubareas',
            'foreignKey' => 'id_area',
            'propertyName' => 'subareas'
        ));
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}