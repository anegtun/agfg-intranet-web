<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoFacturasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_facturas');

        $this->hasMany('Movementos', [
        	'className' => 'EconomicoMovementos',
            'foreignKey' => 'id_factura',
            'propertyName' => 'movementos'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

    public function findAbertas($id = null) {
        $where = ['estado' => 'A'];
        if(!empty($id)) {
            $where = ['OR' => [
                ['estado' => 'A'],
                ['id' => $id]
            ]];
        }

        return $this->find()->where($where)->order(['data'=>'DESC']);
    }

}