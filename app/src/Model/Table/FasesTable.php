<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FasesTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_fase');

        $this->belongsTo('Competicion', [
        	'className' => 'Competicions',
            'foreignKey' => 'id_competicion',
            'propertyName' => 'competicion'
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

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_competicion', 'A competición é obrigatoria')
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio');
    }

}