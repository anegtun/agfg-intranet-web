<?php
namespace App\Model\Table;

class EventosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_eventos');
       
        $this->hasMany('Datas', [
        	'className' => 'EventosDatas',
            'foreignKey' => 'id_evento',
            'propertyName' => 'datas'
        ]);
    }
}