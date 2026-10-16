<?php
namespace App\Model\Table;

use App\Model\TiposFase;
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
        $tiposFase = new TiposFase();

        return $validator
            ->notEmptyString('id_competicion', 'A competición é obrigatoria')
            ->notEmptyString('nome', 'O nome é obrigatorio')
            ->notEmptyString('tipo', 'O tipo é obrigatorio')
            ->inList('tipo', array_keys($tiposFase->getTipos()), 'O tipo de fase non é válido.');
    }

}