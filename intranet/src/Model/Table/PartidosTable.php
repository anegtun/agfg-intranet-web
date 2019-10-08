<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PartidosTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_partidos');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('id_fase', 'A fase da competición é obrigatoria')
            ->notEmpty('id_equipo1', 'O equipo local é obrigatorio')
            ->notEmpty('id_equipo2', 'O equipo visitante é obrigatorio');
    }

}