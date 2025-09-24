<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends AgfgTable {
    
    public function initialize(array $config): void {
        $this->setTable('agfg_users');
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmptyString('nome_usuario', 'O usuario é obrigatorio')
            ->notEmptyString('contrasinal', 'O contrasinal é obrigatorio')
            ->notEmptyString('rol', 'O rol é obrigatorio')
            ->add('rol', 'inList', array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Introduce un valor válido para o rol'
            ));
    }

}