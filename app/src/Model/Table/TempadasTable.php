<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TempadasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_tempadas');
        $this->setPrimaryKey('codigo');
    }
    
    public function findOptions() {
        $list = $this->findSorted();
        $result = [];
        foreach($list as $t) {
            $result[$t->codigo] = $t->nome;
        }
        return $result;
    }
    
    public function findSorted() {
        return $this->find('all', ['order' => 'codigo DESC']);
    }
}