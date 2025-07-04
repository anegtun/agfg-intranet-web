<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class EconomicoMovementosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_economico_movementos');

        $this->belongsTo('Subarea', [
        	'className' => 'EconomicoSubareas',
            'foreignKey' => 'id_subarea',
            'propertyName' => 'subarea'
        ]);

        $this->belongsTo('Clube', [
        	'className' => 'Clubes',
            'foreignKey' => 'id_clube',
            'propertyName' => 'clube'
        ]);

        $this->belongsTo('Factura', [
        	'className' => 'EconomicoFacturas',
            'foreignKey' => 'id_factura',
            'propertyName' => 'factura'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator->notEmpty('importe', 'O importe é obrigatorio');
    }

    public function findbY($query, $prevision = false) {
        $sort = $prevision ? 'asc' : 'desc';
        $movementos = $this
            ->find()
            ->contain(['Subarea' => ['Area' => ['PartidaOrzamentaria']], 'Clube', 'Factura'])
            ->where(['prevision' => $prevision])
            ->order(["EconomicoMovementos.data $sort", "EconomicoMovementos.id $sort"]);

        if(!empty($query['importe'])) {
            if($query['importe'] === 'P') {
                $movementos->where(['EconomicoMovementos.importe >' => 0]);
            } else if ($query['importe'] === 'N') {
                $movementos->where(['EconomicoMovementos.importe <' => 0]);
            }
        }
        if(!empty($query['factura'])) {
            if($query['factura'] === 'CF') {
                $movementos->where(['EconomicoMovementos.id_factura IS NOT' => null]);
            } else if ($query['factura'] === 'SF') {
                $movementos->where(['EconomicoMovementos.id_factura IS' => null, 'EconomicoMovementos.sen_factura' => 0]);
            } else if ($query['factura'] === 'NA') {
                $movementos->where(['EconomicoMovementos.sen_factura' => 1]);
            }
        }
        if(!empty($query['data_ini'])) {
            $movementos->where(['EconomicoMovementos.data >=' => FrozenDate::createFromFormat('d-m-Y', $query['data_ini'])]);
        }
        if(!empty($query['data_fin'])) {
            $movementos->where(['EconomicoMovementos.data <=' => FrozenDate::createFromFormat('d-m-Y', $query['data_fin'])]);
        }
        if(!empty($query['conta'])) {
            $movementos->where(['EconomicoMovementos.conta' => $query['conta']]);
        }
        if(!empty($query['tempada'])) {
            $movementos->where(['EconomicoMovementos.tempada' => $query['tempada']]);
        }
        if(!empty($query['id_partida_orzamentaria'])) {
            $movementos->where(['Area.id_partida_orzamentaria' => $query['id_partida_orzamentaria']]);
        }
        if(!empty($query['id_area'])) {
            $movementos->where(['Subarea.id_area' => $query['id_area']]);
        }
        if(!empty($query['id_subarea'])) {
            $movementos->where(['EconomicoMovementos.id_subarea' => $query['id_subarea']]);
        }
        if(!empty($query['texto'])) {
            $texto = strtoupper($query['texto']);
            $movementos->where(['OR' => [
                'UPPER(EconomicoMovementos.descricion) LIKE' => "%$texto%",
                'UPPER(EconomicoMovementos.referencia) LIKE' => "%$texto%"
            ]]);
        }
        $subarea_activa = $query['subarea_activa'];
        if(!isset($subarea_activa) || !empty($subarea_activa)) {
            $movementos->where(['Subarea.activa' => 1]);
        }
        return $movementos;
    }

}