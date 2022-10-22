<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompeticionsTable extends Table {

    public function initialize(array $config) {
        $this->setTable('agfg_competicion');
       
        $this->hasMany('Fases', array(
        	'className' => 'Fases',
            'foreignKey' => 'id_competicion',
            //'conditions' => ['approved' => true]
            'propertyName' => 'fases',
            //'dependent' => true,
        ));

        $this->belongsTo('Federacion', [
        	'className' => 'Federacions',
        	'foreignKey' => 'id_federacion',
            'propertyName' => 'federacion'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio')
            ->notEmpty('ano', 'O ano é obrigatorio');
    }

}