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
        $bd = $this->find()->order('nome');
        $res = [];
        foreach($bd as $e) {
            $res[$e->id] = $e;
        }
        return $res;
    }

    public function findInFase($id_fase, $type='all', $options=[]) {
        return $this
            ->find($type, $options)
            ->join([
                'table' => 'agfg_fase_equipas',
                'alias' => 'FaseEquipas',
                'type' => 'INNER',
                'conditions' => 'FaseEquipas.id_equipa = Equipas.id',
            ])
            ->where(['FaseEquipas.id_fase'=>$id_fase])
            ->order('nome');
    }

    public function findInFases($id_fases, $type='all', $options=[]) {
        return $this
            ->find($type, $options)
            ->join([
                'table' => 'agfg_fase_equipas',
                'alias' => 'FaseEquipas',
                'type' => 'INNER',
                'conditions' => 'FaseEquipas.id_equipa = Equipas.id',
            ])
            ->where(['FaseEquipas.id_fase IN'=>$id_fases])
            ->order('nome');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}