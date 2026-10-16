<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class ClubesTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_clubes');

        $this->hasMany('Equipas', [
            'joinTable' => 'agfg_federacion_clubes',
            'foreignKey' => 'id_clube'
        ]);

        $this->belongsToMany('Federacions', [
            'joinTable' => 'agfg_federacion_clubes',
            'foreignKey' => 'id_clube',
            'targetForeignKey' => 'id_federacion'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmptyString('codigo', 'O código é obrigatorio')
            ->notEmptyString('name', 'O nome é obrigatorio');
    }

    public function findAGFG() {
        return $this->find()
            ->contain('Federacions')
            ->matching('Federacions', function ($q) {
                return $q->where(['Federacions.codigo' => 'AGFG']);
            })
            ->order('Clubes.nome');
    }

    public function getClubesAmalgama($idClube): array {
        $clube = $this->get($idClube, ['contain' => ['Federacions']]);
        $idsFederacions = array_map(function ($federacion) {
            return $federacion->id;
        }, $clube->federacions);
        if (empty($idsFederacions)) {
            return [];
        }

        return $this->find('list', ['keyField' => 'id', 'valueField' => 'nome'])
            ->matching('Federacions', function ($query) use ($idsFederacions) {
                return $query->where(['Federacions.id IN' => $idsFederacions]);
            })
            ->where(['Clubes.id !=' => $idClube])
            ->distinct(['Clubes.id'])
            ->order(['Clubes.nome'])
            ->toArray();
    }

}