<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EquipasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_equipas');

        $this->belongsTo('Clube', [
        	'className' => 'Clubes',
            'foreignKey' => 'id_clube',
            'propertyName' => 'clube'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

    public function findInFederacion($id_federacion) {
        return $this->find()
            ->contain(['Clube' => 'Federacions'])
            ->matching('Clube.Federacions', function ($q) use ($id_federacion) {
                return $q->where(['Federacions.id' => $id_federacion]);
            })
            ->order('Equipas.nome');
    }

    public function findInFase($fase) {
        $or_condition = ['Equipas.activo' => 1];
        $id_equipas_fase = [];
        foreach($fase->equipas as $e) {
            $id_equipas_fase[] = $e->id;
        }
        if(!empty($id_equipas_fase)) {
            $or_condition['Equipas.id IN'] =  $id_equipas_fase;
        }

        return $this->find()
            ->contain(['Clube' => 'Federacions'])
            ->matching('Clube.Federacions', function ($q) use ($fase) {
                return $q->where(['Federacions.id' => $fase->competicion->id_federacion]);
            })
            ->where(['categoria' => $fase->categoria, 'OR' => $or_condition])
            ->order('Equipas.nome');
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

}