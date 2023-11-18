<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class ClubesTable extends AgfgTable {

    public function initialize(array $config) {
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

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}