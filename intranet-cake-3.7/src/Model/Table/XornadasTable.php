<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class XornadasTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_xornada');
        $this->hasMany('Partidos', array(
        	'className' => 'Partidos',
            'foreignKey' => 'id_xornada',
            //'conditions' => ['approved' => true]
            'propertyName' => 'partidos',
            //'dependent' => true,
        ));
    }

    public function findWithPartidos($id_fase) {
        return $this->find()->contain(['Partidos'])->where(['id_fase'=>$id_fase]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase é obrigatoria')
            ->notEmpty('data', 'A data é obrigatoria')
            ->notEmpty('numero', 'O número de xornada é obrigatorio');
    }

}