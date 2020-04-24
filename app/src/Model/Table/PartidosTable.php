<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PartidosTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_partidos');
        $this->belongsTo('Fases', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
        $this->belongsTo('Xornadas', [
        	'className' => 'Xornadas',
            'foreignKey' => 'id_xornada',
            'propertyName' => 'xornada'
        ]);
        $this->belongsTo('Equipas1', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa1',
            'propertyName' => 'equipa1'
        ]);
        $this->belongsTo('Equipas2', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa2',
            'propertyName' => 'equipa2'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase da competición é obrigatoria')
            ->notEmpty('id_equipa1', 'O equipo local é obrigatorio')
            ->notEmpty('id_equipa2', 'O equipo visitante é obrigatorio');
    }

}