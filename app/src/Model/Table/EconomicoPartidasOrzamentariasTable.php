<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoPartidasOrzamentariasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_partida_orzamentaria');

        $this->hasMany('Areas', array(
        	'className' => 'EconomicoAreas',
            'foreignKey' => 'id_partida_orzamentaria',
            'propertyName' => 'areas'
        ));
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('nome', 'O nome é obrigatorio');
    }

    public function findComplete() {
        return $this->find()
            ->contain(['Areas' => [
                'PartidaOrzamentaria',
                'Subareas' => ['sort' => ['Subareas.activa DESC', 'Subareas.nome']],
                'sort' => 'Areas.nome'
            ]])
            ->order('nome');
    }

}