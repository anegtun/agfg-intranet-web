<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class FasesTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_fase');

        $this->belongsTo('Competicion', [
        	'className' => 'Competicions',
            'foreignKey' => 'id_competicion',
            'propertyName' => 'competicion'
        ]);

        $this->hasMany('Xornadas', [
        	'className' => 'Xornadas',
            'foreignKey' => 'id_fase',
            'propertyName' => 'xornadas'
        ]);

        $this->belongsTo('FasePai', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase_pai',
            'propertyName' => 'fasePai'
        ]);

        $this->belongsToMany('Equipas', [
            'joinTable' => 'agfg_fase_equipas',
            'foreignKey' => 'id_fase',
            'targetForeignKey' => 'id_equipa',
            'propertyName' => 'equipas'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('id_competicion', 'A competición é obrigatoria')
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio');
    }

}