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
        return $validator->notEmptyString('importe', 'O importe é obrigatorio');
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

    public function search($direccion) {
        return $this
            ->find()
            ->where(['direccion' => $direccion])
            ->contain(['Movementos' => ['Area' => 'PartidaOrzamentaria']]);
    }

    public function findAllEntidades($direccion) {
        $query = $this->search($direccion);
        $all = $query->toArray();

        $entidades = [''=>''];
        foreach($all as $f) {
            $entidades[$f->entidade] = $f->entidade;
        }
        asort($entidades);
        
        return $entidades;
    }

}