<?php
namespace App\Model\Table;

class EventosDatasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_eventos_datas');
    }
}