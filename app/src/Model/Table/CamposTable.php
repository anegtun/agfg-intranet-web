<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CamposTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_campos');
    }

    public function findMap($soloActivo = false) {
        $bd = $this->find()->order('nome');
        if  ($soloActivo) {
            $bd->where(['activo' => 1]);
        }
        $res = [];
        foreach($bd as $e) {
            $res[$e->id] = $e;
        }
        return $res;
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('pobo', 'O pobo é obrigatorio');
    }

}