<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class XornadasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_xornada');

        $this->hasMany('Partidos', [
        	'className' => 'Partidos',
            'foreignKey' => 'id_xornada',
            'propertyName' => 'partidos'
        ]);

        $this->belongsTo('Fase', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('id_fase', 'A fase é obrigatoria')
            ->notEmpty('data', 'A data é obrigatoria')
            ->notEmpty('numero', 'O número de xornada é obrigatorio');
    }

    public function findWithPartidos($id_fase) {
        return $this->find()
            ->contain(['Partidos' => [ 'Equipa1' => 'Clube', 'Equipa2' => 'Clube' ]])
            ->where(['id_fase'=>$id_fase])
            ->order('numero');
    }

}