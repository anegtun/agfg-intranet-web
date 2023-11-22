<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class CompeticionsTable extends AgfgTable {

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

    public function findByCodigoOrFail($codigo) {
        $competicion = $this->find()->where(['Competicions.codigo'=>$codigo])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        return $competicion;
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome', 'O nome é obrigatorio')
            ->notEmpty('tipo', 'O tipo é obrigatorio')
            ->notEmpty('ano', 'O ano é obrigatorio');
    }

}