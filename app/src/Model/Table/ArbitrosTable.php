<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class ArbitrosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_arbitros');
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmptyString('alcume', 'O alcume é obrigatorio');
    }

    public function findMap($soloActivo = false) {
        $bd = $this->find()->order('alcume');
        if  ($soloActivo) {
            $bd->where(['activo' => 1]);
        }
        $res = [];
        foreach($bd as $e) {
            $res[$e->id] = $e;
        }
        return $res;
    }

}