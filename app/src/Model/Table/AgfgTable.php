<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AgfgTable extends Table {

    public function getOrNew($id = null) {
        return empty($id) ? $this->newEntity() : $this->get($id);
    }

}