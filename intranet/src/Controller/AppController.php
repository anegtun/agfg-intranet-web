<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', array(
            'enableBeforeRedirect' => false,
        ));
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', array(
            'loginRedirect' => array(
                'controller' => 'Main',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'Main',
                'action' => 'index'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuarios',
                    'fields' => array('username'=>'nome_usuario', 'password'=>'contrasinal')
                )
            )
        ));

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }



    public function beforeFilter(Event $event) {
        //$this->Auth->allow(['index', 'view', 'display']);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), array('application/json', 'application/xml'))
        ) {
            $this->set('_serialize', true);
        }
    }
}