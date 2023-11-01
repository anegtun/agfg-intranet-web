<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AgfgTable extends Table {

    public function getOrNew($id = null, $options = array()) {
        return empty($id) ? $this->newEntity() : $this->get($id, $options);
    }

    public function deleteById($id) {
        $entity = $this->get($id);
        return $this->delete($entity);
    }

}