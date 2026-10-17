<?php
namespace App\Model\Table;

use App\Model\FormatosFase;
use Cake\Validation\Validator;

class FasesTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_fase');
        $this->getSchema()->setColumnType('acarrear_puntos', 'boolean');
        $this->getSchema()->setColumnType('final', 'boolean');

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
        $formatosFase = new FormatosFase();

        return $validator
            ->notEmptyString('id_competicion', 'A competición é obrigatoria')
            ->notEmptyString('nome', 'O nome é obrigatorio')
            ->notEmptyString('formato', 'O formato da fase é obrigatorio')
            ->inList('formato', array_keys($formatosFase->getFormatos()), 'O formato da fase non é válido.')
            ->boolean('acarrear_puntos', 'O valor de arrastre de puntos non é válido.')
            ->boolean('final', 'O indicador de fase final non é válido.');
    }

}