<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class TempadasTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_tempadas');
        $this->setPrimaryKey('codigo');
    }
    
    public function getTempadas() {
        $list = $this->find('all', ['order' => 'codigo DESC']);
        $result = [];
        foreach($list as $t) {
            $result[$t->codigo] = $t->nome;
        }
        return $result;
    }

    public function getTempadasWithEmpty() {
        return array_merge([''=>''], $this->getTempadas());
    }

    public function getTempada($key) {
        $list = $this->getTempadas();
        return $list[$key];
    }
}