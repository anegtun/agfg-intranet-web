<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class FederacionsTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_federacions');

        $this->belongsToMany('Clubes', [
            'joinTable' => 'agfg_federacion_clubes',
            'foreignKey' => 'id_federacion',
            'targetForeignKey' => 'id_clube',
            'propertyName' => 'clubes'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmpty('codigo', 'O código é obrigatorio')
            ->notEmpty('name', 'O nome é obrigatorio');
    }

}