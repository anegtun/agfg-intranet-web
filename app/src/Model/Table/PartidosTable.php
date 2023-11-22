<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PartidosTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_partidos');
        $this->belongsTo('Fase', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
        $this->belongsTo('Xornada', [
        	'className' => 'Xornadas',
            'foreignKey' => 'id_xornada',
            'propertyName' => 'xornada'
        ]);
        $this->belongsTo('Equipa1', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa1',
            'propertyName' => 'equipa1'
        ]);
        $this->belongsTo('Equipa2', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa2',
            'propertyName' => 'equipa2'
        ]);
        $this->belongsTo('Campo', [
        	'className' => 'Campos',
            'foreignKey' => 'id_campo',
            'propertyName' => 'campo'
        ]);
        $this->belongsTo('Arbitro', [
        	'className' => 'Arbitros',
            'foreignKey' => 'id_arbitro',
            'propertyName' => 'arbitro'
        ]);
        $this->belongsTo('Umpire', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_umpire',
            'propertyName' => 'umpire'
        ]);
    }

    public function getDetalle($id) {
        return $this->get($id, [ 'contain' => [
            'Xornada',
            'Fase' => 'Competicion',
            'Equipa1' => 'Clube',
            'Equipa2' => 'Clube'
        ]]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase da competición é obrigatoria')
            ->notEmpty('id_equipa1', 'O equipo local é obrigatorio')
            ->notEmpty('id_equipa2', 'O equipo visitante é obrigatorio');
    }

}