<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EquipasAmalgamasTable extends Table {

    public function initialize(array $config): void {
        $this->setTable('agfg_equipas_amalgamas');
        $this->setPrimaryKey(['id_equipa', 'id_clube']);

        $this->belongsTo('Equipas', [
            'foreignKey' => 'id_equipa'
        ]);
        $this->belongsTo('Clubes', [
            'foreignKey' => 'id_clube'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmptyString('id_equipa', 'A equipa é obrigatoria')
            ->notEmptyString('id_clube', 'O clube é obrigatorio');
    }

    public function getIdsClubesAmalgamaSeleccionados($idEquipa): array {
        if (empty($idEquipa)) {
            return [];
        }

        return $this->find()
            ->select(['id_clube'])
            ->where(['id_equipa' => $idEquipa])
            ->all()
            ->extract('id_clube')
            ->toList();
    }
}
