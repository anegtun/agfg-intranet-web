<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class MovementosPartidaOrzamentariaTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_movemento_partida_orzamentaria');

        $this->hasMany('Areas', array(
        	'className' => 'MovementosArea',
            'foreignKey' => 'id_partida_orzamentaria',
            'propertyName' => 'areas'
        ));
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

    public function findComplete() {
        return $this->find()
            ->contain(['Areas' => [
                'Subareas' => ['sort' => 'Subareas.nome'],
                'sort' => 'Areas.nome'
            ]])
            ->order('nome');
    }

}