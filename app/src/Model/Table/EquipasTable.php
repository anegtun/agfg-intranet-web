<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EquipasTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_equipas');

        $this->belongsTo('Clube', [
        	'className' => 'Clubes',
            'foreignKey' => 'id_clube',
            'propertyName' => 'clube'
        ]);
    }

    public function findMap() {
        $bd = $this
            ->find()
            ->contain(['Clube'])
            ->order('Equipas.nome');
        
            $res = [];
        foreach($bd as $e) {
            $res[$e->id] = $e;
        }
        return $res;
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}