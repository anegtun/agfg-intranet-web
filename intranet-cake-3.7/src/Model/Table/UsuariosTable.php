<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsuariosTable extends Table {
    
    public function initialize(array $config) {
        $this->table('agfg_users');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('nome_usuario', 'O usuario é obrigatorio')
            ->notEmpty('contrasinal', 'O contrasinal é obrigatorio')
            ->notEmpty('rol', 'O rol é obrigatorio')
            ->add('rol', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Introduce un valor válido para o rol'
            ]);
    }

}