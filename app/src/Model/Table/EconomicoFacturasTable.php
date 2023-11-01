<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoFacturasTable extends AgfgTable {

    public function initialize(array $config) {
        $this->setTable('agfg_economico_facturas');
    }

    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

}