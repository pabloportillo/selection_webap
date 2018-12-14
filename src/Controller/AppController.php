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
use vendor\cakephp\cakephp\src\ORM;

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
		//Time::$defaultLocale = 'es-ES';
		//Time::setToStringFormat('dd.MM.YYYY');
		
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'loginAction' => [
				'controller' => 'Usuarios',
				'action' => 'login'
			],
			'authError' => '', //'authError' => 'Usuario no logueado.',
			'authenticate' => [
				'Form' => [
					'fields' => ['username' => 'email', 'password' => 'password']
				]
			],
			'storage' => 'Session'
		]);
		
		
		
        // Allow the display action so our pages controller
        // continues to work.
        $this->Auth->allow(['display']);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
    public function beforeRender(Event $event) {
        $controller = $this->request->params['controller'];
        $action     = $this->request->params['action'];
        $controller = lcfirst($controller);
        $action = lcfirst($action);
       
        $this->loadComponent('Auth');
        if ($this->Auth->user('id')) {
            if (($action != 'login' && $controller != 'error') && ($controller == "usuarios" || $controller == "perfiles" || $controller == "empresas" || $controller == "convocatorias" || $controller == "solicitudes") && ($action == 'index' || $action == 'edit' || $action == 'add' || $action == 'view' || $action == "delete") && $this->request->getSession()->read('Auth.User.Perfile_id') != 1) {

                $session = $this->request->session();
                $perfile_id = $this->request->getSession()->read('Auth.User.Perfile_id');
                if(!$this->verificar_seguridad($controller,$action,$perfile_id)) {
                
               	 return $this->redirect(array('controller' => 'Error', 'action' => 'Permisos'));
                }
            }
        }
    }

    public function verificar_seguridad($controlador, $metodo, $perfile_id) {
        
         $this->loadModel('PerfilAcciones');
            $query = $this->PerfilAcciones
            ->find()
            ->join([
                'acciones' => [
                    'table' => 'acciones',
                    'type' => 'inner',
                    'conditions' => 'PerfilAcciones.accione_id = acciones.id']
                ])
            ->where(['acciones.controlador' => $controlador, 'acciones.metodo' => $metodo, 'PerfilAcciones.perfile_id' => $perfile_id])
            ->toArray();
            
        if (isset($query['0']['perfile_id'])) {
            return true;
        }

        return false;
    }
}
