<?php
namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;

class AgfgTable extends Table {

    public function getOrNew($id = null, $options = []): EntityInterface {
        return empty($id) ? $this->newEntity([]) : $this->get($id, $options);
    }

    public function deleteById($id): bool {
        $entity = $this->get($id);
        return $this->delete($entity);
    }

}