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

        $this->hasMany('Movementos', [
        	'className' => 'EconomicoMovementos',
            'foreignKey' => 'id_subarea',
            'propertyName' => 'movementos',
            'conditions'=> ['prevision' => false],
            'sort' => 'Movementos.data DESC'
        ]);

        $this->hasMany('Previsions', [
        	'className' => 'EconomicoMovementos',
            'foreignKey' => 'id_subarea',
            'propertyName' => 'previsions',
            'conditions'=> ['prevision' => true],
            'sort' => 'Previsions.data ASC'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

}