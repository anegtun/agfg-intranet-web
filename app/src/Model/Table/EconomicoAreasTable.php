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

        $this->hasMany('Movementos', [
        	'className' => 'EconomicoMovementos',
            'foreignKey' => 'id_area',
            'propertyName' => 'movementos',
            'conditions'=> ['prevision' => false],
            'sort' => 'Movementos.data DESC'
        ]);

        $this->hasMany('Previsions', [
        	'className' => 'EconomicoMovementos',
            'foreignKey' => 'id_area',
            'propertyName' => 'previsions',
            'conditions'=> ['prevision' => true],
            'sort' => 'Previsions.data ASC'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmptyString('nome', 'O nome é obrigatorio');
    }

}