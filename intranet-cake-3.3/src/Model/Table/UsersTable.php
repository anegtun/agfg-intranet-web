<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
    
    public function initialize(array $config) {
        $this->table('agfg_users');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('username', 'O usuario é obrigatorio')
            ->notEmpty('password', 'O contrasinal é obrigatorio')
            ->notEmpty('role', 'O rol é obrigatorio')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Introduce un valor válido para o rol'
            ]);
    }

}