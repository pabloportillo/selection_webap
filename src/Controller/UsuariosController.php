<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
/*
 * PORTILLO
 *
 * Para mandar emails añadir:
 */
use Cake\Mailer\Email;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{
	
    /**
     * PORTILLO
     *
     * Funcion necesaria para poder cargar el add de usuarios desde el login.
     */
	
	public function initialize()
	{
		parent::initialize();
		// Add the 'add' action to the allowed actions list.
		$this->Auth->allow(['logout', 'add','recoverpassword','changepassword']);
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empresas', 'Perfiles']
        ];

		$where = "";
			
		// FILTROS de busqueda:
		
			if(isset($_GET['estado']))
			{
				if($_GET['estado'] == 'Activo')
				{
					$where = '(Usuarios.Activo = 1)';

				}else if ($_GET['estado'] == 'Inactivo')
				{
					$where = '(Usuarios.Activo = 0)';

				}else if ($_GET['estado'] == 'Todos')
				{
					$where = '(Usuarios.Activo = 0 OR Usuarios.Activo = 1)';
				}	
			}
            if(isset($_GET['termino']) && ($_GET['termino'] != "")) {
                $where .= ' AND (Usuarios.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Apellidos LIKE "%'.$_GET['termino'].'%" OR Usuarios.Dni LIKE "%'.$_GET['termino'].'%" OR Usuarios.Email LIKE "%'.$_GET['termino'].'%")';
            }
			

		
		if ($this->request->getSession()->read('Auth.User.Perfile_id') != 1 && $this->request->getSession()->read('Auth.User.Perfile_id') != 5) {
		$this->loadModel('Perfiles');
						$query = $this->Perfiles
							->find('all')
							->join([
								'perfil_acciones' => [
									'table' => 'perfil_acciones',
									'type' => 'inner',
									'conditions' => 'perfil_acciones.Perfile_id = Perfiles.id'],
								'acciones' => [
									'table' => 'acciones',
									'type' => 'inner',
									'conditions' => 'perfil_acciones.accione_id = acciones.id']
								])
							->select(['perfil_acciones.accione_id'])
							->where(['perfil_acciones.Perfile_id='.$this->request->getSession()->read('Auth.User.Perfile_id').' AND acciones.controlador="usuarios" AND acciones.metodo="index"'])
							->toArray();
			
			if ($query['0']['perfil_acciones']['accione_id'] == 21) {
				$where = "(Usuarios.Perfile_id IN (2,3,4) AND Usuarios.Empresa_id=".$this->request->getSession()->read('Auth.User.Empresa_id').")";
				
				if(isset($_GET['estado']))
				{
					if($_GET['estado'] == 'Activo')
					{
						$where .= 'AND (Usuarios.Activo = 1)';

					}else if ($_GET['estado'] == 'Inactivo')
					{
						$where .= 'AND (Usuarios.Activo = 0)';

					}else if ($_GET['estado'] == 'Todos')
					{
						$where .= 'AND (Usuarios.Activo = 0 OR Usuarios.Activo = 1)';
					}	
				}
				if (isset($_GET['termino'])) {
					$where .= ' AND (Usuarios.Apellidos LIKE "%'.$_GET['termino'].'%" OR Usuarios.Email LIKE "%'.$_GET['termino'].'%")';
				}
			}
		}
		
        /*if ($this->request->getSession()->read('Auth.User.Perfile_id') == 2) {
            $where = "Usuarios.Perfile_id IN (2,3,4) AND Usuarios.Empresa_id=".$this->request->getSession()->read('Auth.User.Empresa_id');
        }*/

         $usuarios = $this->Usuarios->find('all')
         ->where($where);

        $this->set('Usuarios', $this->paginate($usuarios));
        $this->set(compact('usuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Empresas', 'Perfiles']
        ]);
	    $this->set('usuario', $usuario);
                
        $solicitudes = TableRegistry::get('Solicitudes'); 
        $solicitud = $solicitudes 
            ->find()
            ->where(['usuario_evaluador = '.$id])
            ->first();
        $this->set('solicitud', $solicitud);

        $convocatorias = TableRegistry::get('Convocatorias');
        $convocatoria = $convocatorias
            ->find()
            ->where(['Usuario_id = '.$id])
            ->first();
        $this->set('convocatoria', $convocatoria);
                                
        
    }
	
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
        $usuario = $this->Usuarios->newEntity();
		// la variable 'authUser nos la llevamos a la vista y así comprobar si hay alguien logueado para crear un solicitante desde loguin.
		$this->set('authUser', $this->Auth->user());
        
        if ($this->request->is('post')) {

			$usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
			//Esto es para que previamente lanze las validaciones antes de entrar en el bucle save ( para validar fichero foto basicamente) . Porque si no peta.
            
            if($this->request->getSession()->read('Auth.User.Perfile_id') == null) {
                $usuario->Activo = 1;
            }
            
			if($usuario->errors())
			{
				$fail_add = 'El usuario no se pudo añadir';
				$this->set(compact('fail_add'));
			}else
			{	
				if(strcmp($usuario['Contraseña'] , $this->request->data['Contraseña_match']) ===0)
				{

					$email = new Email('default');
					$correo = $this->request->data['Email'];
					$usuario['Contraseña'] = md5($usuario['Contraseña']);			            
                    
                    //debug ($this->request->data['Foto']);
                    //die();
                    
					// image [error] 4 significa que NO se ha subido ningun fichero. (Si no peta)
					if($this->request->data['Foto']['error'] == 4)	{
						$usuario['Foto'] = null;
					}else
					{
						$imgData = base64_encode(file_get_contents($this->request->data['Foto']['tmp_name']));
						$usuario['Foto'] = $imgData;
					}

					if ($this->request->getSession()->read('Auth.User.Perfile_id') == 2) {
						$usuario['Empresa_id'] = $this->request->getSession()->read('Auth.User.Empresa_id');
					}	
                    
					if ($this->Usuarios->save($usuario)) {

						try {

							$email->to($correo)
								->subject('Bienvenido ' . $this->request->data['Nombre'] . '!')
								->send("Bienvenido a Plataforma Seleccion! \n\nTu usuario es: " . $correo . "\nContraseña: " . $this->request->data['Contraseña']);

						} catch (Exception $e){

							$this->Flash->error(__('Error al enviar email: ' . $e->getMessage()));
						}

						if($this->Auth->user('id'))
						{
							return $this->redirect(['action' => 'index','success_add' => 1]);	

						}else
						{
							return $this->redirect(['action' => 'login','success_add' => 1]);
						}

					}

				} else
				{
					$dont_match = 'Las contraseñas no coinciden.';
					$confirm_pass = $this->request->data['Contraseña_match'];
					$this->set(compact('dont_match','confirm_pass'));
				}

				$fail_add = 'El usuario no se pudo añadir';
				$this->set(compact('fail_add'));
			
			}	
        }
       
		/*
		* PORTILLO
		*
		* Para poner el valor del campo de otra tabla en vez del id (en este caso el nombre de la empresa):
		* 	1. Primero cargamos el modelo con el que queremos trabajar.
		*	2. luego hacemos un find('list') y el select tal y como se ve abajo.
		*/
		
		$this->loadModel('Empresas');
		$empresas = $this->Empresas->find('list', ['valueField' => 'NombreEmpresa'])->select(['id' ,'NombreEmpresa']);
		
 		/*
		* PORTILLO
		*
		* Lo mismo para perfiles
		*/
        $where = "";
        if ($this->request->getSession()->read('Auth.User.Perfile_id') == 2) {
            $where = "id IN (2,3,4)";
        }
		$this->loadModel('Perfiles');
		
		$perfiles = $this->Perfiles->find('list', ['valueField' => 'Nombre'])->where($where)->select(['id' ,'Nombre'])->order(['id']);
	
        $this->set(compact('usuario', 'empresas', 'perfiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
		//SEGURIDAD URL PARA QUE NO PUEDAN EDITAR IDs DE OTROS USUARIOS CAMBIANDO EL ID EN LA URL
		$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $urlArray);
		$numSegments = count($segments); 
		$currentSegment = $segments[$numSegments - 1]; 
		
		$user_id_sesion = $this->request->getSession()->read('Auth.User.id');
		$user_id_perfil = $this->request->getSession()->read('Auth.User.Perfile_id');
		$user_id_empresa = $this->request->getSession()->read('Auth.User.Empresa_id');
		
		if(($user_id_sesion == $currentSegment) || ($user_id_perfil == 1) || ($user_id_perfil == 2)) {
			
			if($user_id_perfil == 2) {
				$val = false;
				$query = $this->Usuarios
						->find('all')
						->where(['Usuarios.Empresa_id='.$user_id_empresa])
						->toArray(); 
				
				for($i=0; $i<count($query); $i++) {

					if($query[$i]['id'] == $currentSegment)	{
						$val = true;
					}
				}

				if($val == false) {
					
					return $this->redirect(['controller' => 'error','action' => 'permisos']);
				}	
			}
			
			$usuario = $this->Usuarios->get($id, [
				'contain' => []
			]);

			$pwd = $usuario['Contraseña'];
            $foto = $usuario['Foto'];

			if ($this->request->is(['patch', 'post', 'put'])) {
				$usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
				
                    
					if(($this->request->data['Contraseña'] === $this->request->data['Contraseña_match'])) {
                        
						if($this->request->data['Contraseña'] === $pwd)	{
							$usuario['Contraseña'] = $usuario['Contraseña'];
						}else if(($this->request->data['Contraseña'] === $this->request->data['Contraseña_match'])) {
							$usuario['Contraseña'] = md5($usuario['Contraseña']);
						}
             
						// image [error] 4 significa que NO se ha subido ningun fichero. (Si no peta)
						if($this->request->data['Foto']['error'] == 4)	{
							$usuario['Foto'] = $foto;						
						}else {                        
							$imgData = base64_encode(file_get_contents($this->request->data['Foto']['tmp_name']));
							$usuario['Foto'] = $imgData;
						}
                        
						if ($this->Usuarios->save($usuario)) {
                            if($user_id_perfil == 5 || $user_id_perfil == 4 || $user_id_perfil == 3) {
                                return $this->redirect(['controller' => 'Home', 'action' => 'index', 'success_edit' => 1]); 
                            }else {
							    return $this->redirect(['action' => 'index','success_edit' => 1]);  
                            }
						}
                        
					} else {
						$dont_match = 'Las contraseñas no coinciden.';
						$confirm_pass = $this->request->data['Contraseña_match'];
						$this->set(compact('dont_match','confirm_pass'));
					}
					$fail_add = 'El Usuario no se pudo guardar.';
					$this->set(compact('fail_add'));
			}
			
			$this->loadModel('Empresas');
			$empresas = $this->Empresas->find('list', ['valueField' => 'NombreEmpresa'])->select(['id' ,'NombreEmpresa']);

			$where = "";
			if ($this->request->getSession()->read('Auth.User.Perfile_id') == 2) {
				$where = "id IN (2,3,4)";
			}

			$this->loadModel('Perfiles');
			$perfiles = $this->Perfiles->find('list', ['valueField' => 'Nombre'])->where($where)->select(['id' ,'Nombre']);
			$this->set(compact('usuario', 'empresas', 'perfiles'));

		}else
		{
			return $this->redirect(['controller' => 'error','action' => 'permisos']);
		}
	}

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        
		$this->loadModel('Convocatorias');
        $this->Convocatorias->deleteAll(['Usuario_id' => $id]);
		
		
        if ($this->Usuarios->delete($usuario)) {
            return $this->redirect(['action' => 'index','success_delete' => 1]);
        } else {
            return $this->redirect(['action' => 'index','fail_delete' => 1]);
        }
    } 

    public function deleteuser(){        
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        
        if ($this->request->is('post')) {
            
            $usuario_id = $_POST['id'];
            
            $usuarios = TableRegistry::get('Usuarios');
            $usuario = $usuarios->get($usuario_id);
            
            $solicitudes = TableRegistry::get('Solicitudes'); 
            $solicitud = $solicitudes 
                ->find()
                ->where(['usuario_evaluador = '.$usuario_id])
                ->first();
            
            $convocatorias = TableRegistry::get('Convocatorias');
            $convocatoria = $convocatorias
                ->find()
                ->where(['Usuario_id = '.$usuario_id])
                ->first();
                        
            if(($solicitud == null) && ($convocatoria == null)){
                $result = true;
                echo json_encode(array('result' => $result));
                /*
                if($usuarios->delete($usuario)) {
                     $result = true;
                     echo json_encode(array('result' => $result));
                } else {
                    $result = false;
                    echo json_encode(array('result' => $result)); 
                } */
            }else {
                $result = false;
		        echo json_encode(array('result' => $result)); 
            }
        }
    }  

/**********************************************************************************************************************************/
 
	/**
	* PORTILLO:
	*
	* Añadimos funciones: login(), verifica_usuario(), guarda_intentos() y logout() 
	*
	*
	*
	*/
    
     public function login(){

        //$this->loadModel('Usuarios');
        //$this->loadModel('Log');
		 
        if($this->Auth->user('id'))
		{
			//$this->Flash->default(__('Ya se encuentra logueado!'));
			return $this->redirect(['controller' => 'Home', 'action' => 'index']);
				
		}else{	 

        if($this->request->is('post')){	
			
			$user = ($this->request['data']['email']);
            //$pass = ($this->request['data']['password']);
			$pass = md5($this->request['data']['password']);
			//$pass = password_hash(($this->request['data']['password']), PASSWORD_BCRYPT); // Variable $pass que guarda la password en md5 ( y MD5 en la base de datos)
			
			//var_dump($pass);
			//die();
			
            $tipo_sesion = $this->verifica_usuario($user, $pass); 
            //echo ($tipo_sesion);
            //echo var_dump($tipo_sesion);die;

            if($tipo_sesion==1){
                
            //$this->Flash->success('¡Bienvenido!', ['key' => 'auth']);
			//	$this->Flash->success(__('¡Bienvenido!'));
				$nombre = $this->request->getSession()->read('Auth.User.Activo');

                return $this->redirect(['controller' => 'home', 'action' => 'index']); // ESTO NOS LLEVA A LA PÁGINA DE INICIO
 
            }elseif($tipo_sesion==4){

             // $this->Log->write('El usuario no existe en la base de datos',E_WARNING);
			 // $this->Flash->error('Su cuenta está bloqueada, por favor contactarse con el Administrador.', ['key' => 'auth']);+
             // $mensaje_error = 'El usuario no existe en la base de datos';
				$mensaje_error2 = 'Email o contraseña incorrectos.';
                $this->set(compact('mensaje_error2'));

            }elseif($tipo_sesion==2){

             // $this->Log->write('Su cuenta está bloqueada, por favor contactarse con el Administrador.',E_WARNING);
             // $this->Flash->error('Su cuenta está bloqueada, por favor contactarse con el Administrador.', ['key' => 'auth']);+
             // $mensaje_error = 'Su cuenta está bloqueada, por favor contactarse con el Administrador.';
                $mensaje_error3 = 'Su cuenta está deshabilitada, por favor contacte con el Administrador.';
                $this->set(compact('mensaje_error3'));

            }elseif($this->guarda_intentos($user) >= 3){ 

             // $this->bloquea_usuario($user);
             // $this->Log->write('Superó los intentos de inicio de sesión.',E_WARNING);
             // $this->Flash->error('Superó los intentos de inicio de sesión.', ['key' => 'auth']);
				$mensaje_error2 = 'Email o contraseña incorrectos.';
                $this->set(compact('mensaje_error2'));
            }else{

             // $this->Log->write('Los datos son inválidos.',E_WARNING);
             // $this->Flash->error('Los datos son inválidos.', ['key' => 'auth']);
				$mensaje_error2 = 'Email o contraseña incorrectos.';
                $this->set(compact('mensaje_error2'));   
        }
    }
	}
}
    
    //verifica si el usuario existe y esta activo

    public function verifica_usuario($user, $pass){
            
          // $Usuarios = TableRegistry::get('Usuarios', $config); // Carga los registros de la tabla
            $this->loadModel('Usuario'); // Carga el modelo de Usuario /src/model/entity/Usuario.php
            $query_val = $this->Usuarios
            ->find()
            ->where(['Email' => $user])
            ->toArray();
        
             if(is_array($query_val) && count($query_val)>0){

                $query = $this->Usuarios
                ->find()
                ->where(['Email' => $user, 'Contraseña' => $pass])
                ->toArray();

                if(is_array($query) && count($query)>0){

                    if($query[0]['Activo']=='1'){

                        $persona = $this->Usuarios->get($query[0]['id']);
                        
                        //update de los campos
                        $persona->datetime_ultimo_login = date('Y-m-d H:i:s');
                        $persona->error_login = '0';
                        //confirmar save
                        $this->Usuarios->save($persona);
                        $this->Auth->setUser($query[0]);
                        return 1;

                    }else{

                        return 2;
                    }

                }else{

                    $rs_ver = $this->Usuarios
                    ->find()
                    ->where(['Email' => $user])
                    ->toArray();
                    $active_persona = isset($rs_ver[0]['Activo']) && $rs_ver[0]['Activo']!='' ? $rs_ver[0]['Activo'] : '';

                    if($active_persona!='1'){

                        return 2;

                    }else{

                        return 3;
                    }
                }

            }else{

                return 4;
            }               
    }

    //guarda los intentos de sesion del usuario

    public function guarda_intentos($user){

        $this->loadModel('Usuario');
        $contador_session = 0;
        $rs_ver = $this->Usuarios
        ->find()
        ->where(['Email' => $user])
        ->toArray();

        if(is_array($rs_ver) && count($rs_ver)>0){

            if($rs_ver[0]['Activo']=='1'){

                $contador_session = isset($rs_ver[0]['error_login']) && $rs_ver[0]['error_login']!='' ? ($rs_ver[0]['error_login']+1) : '0';
                $persona = $this->Usuarios->get($rs_ver[0]['id']);
                $persona->error_login = $contador_session;
                //confirmar save
                $this->Usuarios->save($persona);

            }else{

                $contador_session = 4;
            }
        }
        return $contador_session;

    }
    
	//Cerramos Sesion
	
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    function recoverpassword() {

        if ($this->request->is('post')) {
            // Primero compruebo si existe un usuario con ese email en la base de datos
            $query = $this->Usuarios
            ->find()
            ->where(['Email' => $_POST['email']])
            ->toArray();

            if (isset($query['0']['id'])) {
                
                // Genero un token
                $token = md5($query['0']['id']."#".$_POST['email']);

                // Pongo una fecha al token
                $usuarios = TableRegistry::get("Usuarios");
                $query2 = $usuarios->query();
                
                $fecha = strftime('%F');
                
                $fechatoken = $query2->update()
                ->set(['fecha_token' => $fecha])
                ->where(['id' => $query['0']['id']])
                ->execute();

                $descripcion = "<a href='http://".$_SERVER['HTTP_HOST']."/usuarios/changepassword?id=".$query['0']['id']."&token=".$token."'>Haga click aquí para restablecer la contraseña</a>";
                $correo = new CorreosController;

                // Envio un correo al entrevistador avisándole de que ahora es un entrevistador de la oferta
                $correo->enviarcorreo(1, $query['0']['Nombre']." ".$query['0']['Apellidos'], $query['0']['Email'],$descripcion);
                return $this->redirect(['action' => 'login','emailsended' => true]);
            } else {
                $not_found = true;
                $this->set(compact('not_found'));
            }
        }
    }

        public function changepassword() {
        if (isset($_GET['token'])) {

            $query = $this->Usuarios
            ->find()
            ->where(['id' => $_GET['id']])
            ->toArray();
            $token_bd = md5($_GET['id']."#".$query['0']['Email']);

            if ($_GET['token'] == $token_bd) {
                if (!isset($query['0']['fecha_token'])) {
                    return $this->redirect(['action' => 'login','invalid_token' => true]);
                }

                $fecha_actual = strftime('%F');
                $fecha_token = $query['0']['fecha_token']->i18nFormat('YYY-MM-dd');
                //$intervalo = $fecha_token->diff($fecha_actual);
                $dias = (strtotime($fecha_token)-strtotime($fecha_actual))/86400;
                $dias = abs($dias);
                $dias = floor($dias);
                if ($dias > 1) {
                    return $this->redirect(['action' => 'login','timed_out_token' => true]);
                }

            } else {
                return $this->redirect(['action' => 'login','invalid_token' => true]);
            }

        } else {
            return $this->redirect(['action' => 'login','prohibido' => true]);
        }

        if ($this->request->is('post')) {
            if ($_POST['password'] == $_POST['confirmpassword']) {
                $usuarios = TableRegistry::get("Usuarios");
                $query2 = $usuarios->query();
                                
                $fechatoken = $query2->update()
                ->set(['Contraseña' => md5($_POST['password']),'fecha_token' => null])
                ->where(['id' => $query['0']['id']])
                ->execute();

                return $this->redirect(['action' => 'login','password_changed' => true]);

            } else {
                $not_match = true;
                $this->set(compact('not_match'));
            }


        }
    }
}