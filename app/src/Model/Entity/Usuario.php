<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Usuario extends Entity {

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = array(
        '*' => true,
        'id' => false
    );

    protected function _setContrasinal($contrasinal) {
        return (new DefaultPasswordHasher)->hash($contrasinal);
    }

}