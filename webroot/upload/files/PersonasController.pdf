<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Session;
use Cake\Utility\Security;

use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
//
/**
 * Personas Controller
 *
 * @property \App\Model\Table\PersonasTable $Personas
 */
class PersonasController extends AppController
{

    public $components = array('Flash', 'RequestHandler');
    public function ayuda(){
        $this->session = new Session();
        $perfilUsuarioActual = $this->session->read('Auth.User.perfile_id');

        $this->set('perfilUsuarioActual',$perfilUsuarioActual);
        
    }

    public function login(){
        //$this->loadModel('personas');
        $mensaje_error = ''; 
        $this->loadModel('Log');
        if($this->request->is('post')){
            $user = ($this->request['data']['user']);
            $pass = sha1($this->request['data']['password']);

            
            $tipo_sesion = $this->verifica_usuario($user, $pass);
            //echo ($tipo_sesion);
            //echo var_dump($tipo_sesion);die;
            if($tipo_sesion==1){
                //$this->Flash->success('¡Bienvenido!', ['key' => 'auth']);
                $this->Log->write('¡Bienvenido!',E_NOTICE);
                return $this->redirect($this->Auth->redirectUrl());

            }elseif($tipo_sesion==4){
                $this->Log->write('El usuario no existe en la base de datos',E_WARNING);
                //$this->Flash->error('Su cuenta está bloqueada, por favor contactarse con el Administrador.', ['key' => 'auth']);+
                $mensaje_error = 'El usuario no existe en la base de datos'; 
            }elseif($tipo_sesion==2){
                
                $this->Log->write('Su cuenta está bloqueada, por favor contactarse con el Administrador.',E_WARNING);
                //$this->Flash->error('Su cuenta está bloqueada, por favor contactarse con el Administrador.', ['key' => 'auth']);+
                $mensaje_error = 'Su cuenta está bloqueada, por favor contactarse con el Administrador.'; 
            }elseif($this->guarda_intentos($user) >= 3){
                $this->bloquea_usuario($user);
                $this->Log->write('Superó los intentos de inicio de sesión.',E_WARNING);
                $this->Flash->error('Superó los intentos de inicio de sesión.', ['key' => 'auth']);
            }else{
                $this->Log->write('Los datos son inválidos.',E_WARNING);
                $this->Flash->error('Los datos son inválidos.', ['key' => 'auth']);
            }
        }

        $this->set('mensaje_error', $mensaje_error);
    }
    //verifica si el usuario existe y esta activo
    public function verifica_usuario($user, $pass){
            //$personas = TableRegistry::get('personas');
            $this->loadModel('personas');
            $query_val = $this->personas
            ->find()
            ->where(['username' => $user])
            ->toArray();
            if(is_array($query_val) && count($query_val)>0){
                $query = $this->personas
                ->find()
                ->where(['username' => $user, 'password' => $pass])
                ->toArray();
                if(is_array($query) && count($query)>0){
                    if($query[0]['active']=='1'){
                        $persona = $this->personas->get($query[0]['id']);
                        //update de los campos
                        $persona->datetime_ultimo_login = date('Y-m-d H:i:s');
                        $persona->error_login = '0';
                        //confirmar save
                        $this->personas->save($persona);
                        $this->Auth->setUser($query[0]);
                        return 1;
                    }else{
                        return 2;
                    }
                }else{
                    $rs_ver = $this->personas
                    ->find()
                    ->where(['username' => $user])
                    ->toArray();
                    $active_persona = isset($rs_ver[0]['active']) && $rs_ver[0]['active']!='' ? $rs_ver[0]['active'] : '';
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

        $this->loadModel('personas');

        $contador_session = 0;

        $rs_ver = $this->personas
        ->find()
        ->where(['username' => $user])
        ->toArray();
        if(is_array($rs_ver) && count($rs_ver)>0){
            if($rs_ver[0]['active']=='1'){
                $contador_session = isset($rs_ver[0]['error_login']) && $rs_ver[0]['error_login']!='' ? ($rs_ver[0]['error_login']+1) : '0';

                $persona = $this->personas->get($rs_ver[0]['id']);
                $persona->error_login = $contador_session;
                //confirmar save
                $this->personas->save($persona);
            }else{
                $contador_session = 4;
            }
        }
        return $contador_session;
    }

    public function home(){
        $this->session = new Session();
        $perfilUsuarioActual = $this->session->read('Auth.User.perfile_id');
        $tipoUsuarioActual = $this->session->read('Auth.User.tipospersona_id');
        $actual = $this->session->read('Auth.User.perfile_id');
        $notificacionesHome = $this->notificacionesHome();
        $this->set('notificacionesHome', $notificacionesHome);
        //$diabetes = $this->diabetes();
        //$obesidad = $this->obesidad();
        $diabetesObesidad = $this->diabetesObesidad();
      
        //$this->set('diabetes', $diabetes);
        //  $this->set('obesidad', $obesidad);
         $this->set('diabetesObesidad', $diabetesObesidad);
        $this->set('perfilUsuarioActual', $perfilUsuarioActual);
        $this->set('tipoUsuarioActual', $tipoUsuarioActual);
		//(new NotificacionesController())->tareasCron();
        /*if($actual==8){
           return $this->redirect(
            ['controller' => 'Reporteria', 'action' => 'pagos']
        );
        }*/
    }

    public function logout(){
        //$this->loadModel('Log');
        //$this->Log->write('Cierra sesión',E_NOTICE);
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->session = new Session();
        $perfile_id = $this->session->read('Auth.User.perfile_id');
        $this->set(compact('perfile_id'));
        //$this->set('_serialize', ['perfile_id']);


		$personas = $this->Personas->find('all', array('contain' => ['Perfiles']));
		$personas = $personas->toArray();
        
        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

    /**
     * View method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $persona = $this->Personas->get($id, [
            'contain' => ['Paises', 'Regiones', 'Ciudades', 'Perfiles', 'Tipospersonas', 'DatosControlPacientes', 'ObesidadComentarios', 'ObesidadEducaciones', 'ObesidadEventoAdversos', 'ObesidadGestiones', 'ObesidadGestionxenfermeraxnutricionistas', 'ObesidadLlamadas', 'ObesidadQuejaCalidads', 'ObesidadRegistroContactos', 'Representantesxmedicos', 'Tickets']
        ]);

        $this->set('persona', $persona);
        $this->set('_serialize', ['persona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Log');
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            
            if(isset($this->request['data']['validate'])){
                $validate = $this->request['data']['validate'];}
            else{
                $validate =0;
            }
            if($validate==1){
                $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
                $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
            }else if($this->request->data['password']!=$this->request->data['confirm_password']){
                $this->Flash->error(__('La contraseña no coincide.'));
                $this->Log->write('La contraseña no coincide.',E_WARNING);
            }else if($this->request->data['password']==""){
                $this->Flash->error(__('Debe rellenar las contraseñas.'));
                $this->Log->write('Debe rellenar las contraseñas.',E_WARNING);
            }else{
                $persona = $this->Personas->patchEntity($persona, $this->request->data);
                $persona->password=sha1($this->request->data['password']);
                if ($this->Personas->save($persona)) {
                    $this->recuperarClaveCall($persona->id,$persona->perfile_id);
                //var_dump($persona->perfile_id);die;                
                    $this->Log->write('Se ha creado correctamente el nuevo usuario "'.$this->request->data['username'].'".',E_NOTICE);
                    $this->Flash->success(__('Se ha creado correctamente el nuevo usuario "'.$this->request->data['username'].'".'));

                    return $this->redirect(['action' => 'index']);

                } else {
                    $this->Flash->error(__('El usuario "'.$this->request->data['username'].'" no se ha podido crear. Por favor, inténtelo de nuevo.'));
                    $this->Log->write('El usuario "'.$this->request->data['username'].'" no se ha podido crear. Por favor, inténtelo de nuevo.',E_WARNING);
               }
            }

           
        }
        $paises = $this->Personas->Paises->find('list', ['limit' => 200])->order(['id' => 'ASC']);
        $regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
        $ciudades = $this->Personas->Ciudades->find('list', ['limit' => 200]);
        $perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200])->where(['id' => 1])->orwhere(['id' => 2])->orwhere(['id' => 3])->orwhere(['id' => 5])->orwhere(['id' => 8])->orwhere(['id' => 9])->orwhere(['id' => 10])->orwhere(['id' => 11])->orwhere(['id' => 12]);
        $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200]);
        $this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'perfiles', 'tipospersonas'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Log');
		$persona = $this->Personas->get($id, [
            'contain' => []
        ]);
		$passwordOriginal= $persona->password;
		$persona->password="";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $validate = $this->request['data']['validate'];
            if($validate==1){
                $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
                $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
            }else if($this->request->data['password']!=$this->request->data['confirm_password']){
                $this->Flash->error(__('La contraseña no coincide.'));
                $this->Log->write('La contraseña no coincide.',E_WARNING);
            }else{
                $persona = $this->Personas->patchEntity($persona, $this->request->data);
    			if ($this->request->data['password']=="") {
                    $persona->password=$passwordOriginal;
                   
                }
				else {
                    $persona->password=sha1($this->request->data['password']);
                    if ($this->request->data['active']==1){
                        $persona->error_login=0;
                    }
            }
                if ($this->Personas->save($persona)) {
                    $this->Flash->success(__('Se ha modificado correctamente el usuario "'.$this->request->data['username'].'".'));
    				$this->Log->write(__('Se ha modificado correctamente el usuario "'.$this->request->data['username'].'".'),E_NOTICE);

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('El usuario "'.$this->request->data['username'].'" no se ha podido modificado. Por favor, inténtelo de nuevo.'));
    				$this->Log->write('El usuario "'.$this->request->data['username'].'" no se ha podido modificado. Por favor, inténtelo de nuevo.',E_WARNING);
                }
            }
        }
        $paises = $this->Personas->Paises->find('list', ['limit' => 200])->order(['id' => 'ASC']);
        $regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
        $ciudades = $this->Personas->Ciudades->find('list', ['limit' => 200]);
        $perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200])->where(['id' => 1])->orwhere(['id' => 2])->orwhere(['id' => 3])->orwhere(['id' => 5])->orwhere(['id' => 8])->orwhere(['id' => 9])->orwhere(['id' => 10])->orwhere(['id' => 11])->orwhere(['id' => 12]);
        $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200]);
        $this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'perfiles', 'tipospersonas'));
        $this->set('_serialize', ['persona']);
    }

    public function active($id = null)
    {
        $this->loadModel('Log');
		$mensajeOK = '';
		$mensajeKO = '';
		$this->request->allowMethod(['get']);
        $persona = $this->Personas->get($id);
        if($persona->active == 1){
            $persona->active = 0;
			$mensajeOK = 'Se ha desactivado al usuario "'.$persona->username.'".';
			$mensajeKO = 'No se ha podido desactivar al usuario "'.$persona->username.'".';
        } else {
            $persona->active = 1;
            $persona->error_login = 0;
			$mensajeOK = 'Se ha activado al usuario "'.$persona->username.'".';
			$mensajeKO = 'No se ha podido activar al usuario "'.$persona->username.'".';
			$this->loadModel('correos');
			$descripcion = 'Su cuenta en la plataforma Centro NovoCare ha sido activada. Puede acceder utilizando sus credenciales o si no recuerda su contraseña puede utilizar el enlace "¿Olvidó su contraseña?" que se encuentra en la pantalla de identificación de la plataforma.';
			$nombre_persona = $persona->name.' '.$persona->apellido1.' '.$persona->apellido2;
			$persona_email = $persona->email;
			$msj_email = $this->correos->enviarcorreo(3, $id,$nombre_persona,$persona_email, $descripcion);
        }
        if ($this->Personas->save($persona)) {
            $this->Flash->success(__($mensajeOK));
			$this->Log->write(__($mensajeOK),E_NOTICE);
        } else {
            $this->Flash->error(__($mensajeKO));
			$this->Log->write(__($mensajeKO),E_WARNING);
        }

        return $this->redirect(['action' => 'index']);
    }


    public function recuperarClave(){
        $this->autoRender = false;
		$this->loadModel('Log');
		
        $result = false;
        $debug  = false;
        if($this->request->is('post')){

            try{
                //cargar datos de post
                $textemail  = isset($_POST['textemail']) && $_POST['textemail']!='' ? $_POST['textemail'] : '';
                //traer modelo
                $this->loadModel('personas');
                $this->loadModel('correos');
                $rs = $this->personas
                ->find()
                ->where(['email' => $textemail])
                ->toArray();
                if(is_array($rs) && count($rs)>0){
                    //generar contraseña random
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 7; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }


                    //traer objeto con el id de la fila
                    $persona = $this->personas->get($rs[0]['id']);
                    //update de los campos
                    $persona->active = 0;
                    $persona->password = sha1($randomString);
                    //confirmar save
                    $this->personas->save($persona);
                    $descripcion = 'Su nueva clave es: '.$randomString;
                    $nombre_persona = $rs[0]['name'].' '.$rs[0]['apellido1'].' '.$rs[0]['apellido2'];
                    $msj_email = $this->correos->enviarcorreo(1, $rs[0]['id'],$nombre_persona,$textemail, $descripcion);


                    $result = true;
                    $debug = 'Olvidó su contraseña: El correo electrónico se envió correctamente a "'.$persona->email.'"';
                    $this->Flash->success(__($debug));
					$this->Log->write(__($debug),E_NOTICE);
                }else{
                    $result = false;
                    $debug = 'Olvidó su contraseña: El correo electrónico "'.$textemail.'" no está registrado en el sistema';
                    $this->Flash->error(__($debug));
					$this->Log->write(__($debug),E_WARNING);
                }

            }catch (Exception $e) {
                $result = false;
                $debug = 'Excepción capturada: '. $e->getMessage(). "\n";
				$this->Log->write(__($debug),E_ERROR);
                $this->Flash->error(__($debug));
            }
        }

        echo json_encode(array('result' => $result, 'debug' => $debug));
    }

    //metodo para enviar claves a correo de manera masiva
    public function recuperarClaveUser(){
        $this->autoRender = false;
        $this->loadModel('Log');
        
        $result = false;
        $debug  = false;
        /*try{
                //cargar datos de post
                //traer modelo
                $this->loadModel('personas');
                $this->loadModel('correos');
                $rs = $this->personas
                ->find()
                ->where(['id' => 2270])
                ->toArray();
                if(is_array($rs) && count($rs)>0){

                    foreach ($rs as $row) {
                        if($textemail = $row['email']!=''){
                            //generar contraseña random
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < 7; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }


                            //traer objeto con el id de la fila
                            $persona = $this->personas->get($row['id']);
                            //update de los campos
                            $persona->active = 0;
                            $persona->password = sha1($randomString);
                            //confirmar save
                            $this->personas->save($persona);
                            
                            $nombre_persona = $row['name'].' '.$row['apellido1'].' '.$row['apellido2'];
                            //$textemail = $row['email'];
                            $textemail = 'fanparedes@gmail.com';
                            
                            
                            $descripcion['nombre'] = $nombre_persona;
                            $descripcion['email'] = $textemail;
                            $descripcion['username'] = $row['username'];
                            $descripcion['clave'] = $randomString;
                            
                            $msj_email = $this->correos->enviarcorreo(10, $row['id'],$nombre_persona,$textemail, $descripcion);


                            $result = true;
                            $debug = 'Su usuario y contraseña: El correo electrónico se envió correctamente a "'.$persona->email.'"';
                            //$this->Flash->success(__($debug));
                            $this->Log->write(__($debug),E_NOTICE);
                        }
                        
                    }
                }else{
                    $result = false;
                    $debug = 'Olvidó su contraseña: El correo electrónico "'.$textemail.'" no está registrado en el sistema';
                    //$this->Flash->error(__($debug));
                    $this->Log->write(__($debug),E_WARNING);
                }

            }catch (Exception $e) {
                $result = false;
                $debug = 'Excepción capturada: '. $e->getMessage(). "\n";
                $this->Log->write(__($debug),E_ERROR);
                //$this->Flash->error(__($debug));
            }*/
            $descripcion = 'Se ha creado un ticket de Farmacovigilancia (Quejas de calidad)';
            $this->loadModel('personas');
            $this->loadModel('correos');
            $rs_personas = $this->personas
            ->find()
            ->where(['perfile_id' => 2])
            ->toArray();
            if(is_array($rs_personas) && count($rs_personas)>0){
                foreach ($rs_personas as $row) {
                    $nombre_persona = $row['name'].' '.$row['apellido1'].' '.$row['apellido2'];

                    $persona_email = $row['email'];
                    //var_dump($nombre_persona); die;
                    //echo $idticket.' - '.$nombre_persona.' - '.$persona_email.' - '.$descripcion; die;
                    $msj_email = $this->correos->enviarcorreo(7, 160,$nombre_persona,$persona_email, $descripcion);
                }
            }

    }

    
    public function recuperarClaveCall($personaid,$perfile_id){
        $this->autoRender = false;
        $this->loadModel('Log');
        $result = false;
        $debug  = false;
        try{    
                //cargar datos de post
                //traer modelo
                $this->loadModel('personas');
                $this->loadModel('correos');
                $rs = $this->personas
                ->find()
                ->where(['id' => $personaid])
                ->toArray();

                if(is_array($rs) && count($rs)>0){

                    

                    foreach ($rs as $row) {
                        //generar contraseña random
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < 7; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }

                        
                        //traer objeto con el id de la fila
                        $persona = $this->personas->get($row['id']);
                        //update de los campos
                        $persona->active = 0;
                        $persona->password = sha1($randomString);
                        //confirmar save
                        $this->personas->save($persona);
                        
                        $nombre_persona = $row['name'].' '.$row['apellido1'].' '.$row['apellido2'];
                        $textemail = $row['email'];
                        
                        
                        $descripcion['nombre'] = $nombre_persona;
                        $descripcion['email'] = $textemail;
                        $descripcion['username'] = $row['username'];
                        $descripcion['clave'] = $randomString;

                    $msj_email = $this->correos->enviarcorreo(11, $row['id'],$nombre_persona,$textemail, $descripcion, $perfile_id);


                        $result = true;
                        $debug = 'Su usuario y contraseña: El correo electrónico se envió correctamente a "'.$persona->email.'"';
                        //$this->Flash->success(__($debug));
                        $this->Log->write(__($debug),E_NOTICE);
                    }
                }else{
                    $result = false;
                    //$debug = 'Olvidó su contraseña: El correo electrónico "'.$textemail.'" no está registrado en el sistema';
                    //$this->Flash->error(__($debug));
                    $this->Log->write(__($debug),E_WARNING);
                }

            }catch (Exception $e) {
                $result = false;
                $debug = 'Excepción capturada: '. $e->getMessage(). "\n";
                $this->Log->write(__($debug),E_ERROR);
                //$this->Flash->error(__($debug));
            }


    }
    

    /*public function recuperarClaveCall(){
        $this->autoRender = false;
        $this->loadModel('Log');
        
        $result = false;
        $debug  = false;
        try{
                //cargar datos de post
                //traer modelo
                $this->loadModel('personas');
                $this->loadModel('correos');
                $rs = $this->personas
                ->find()
                ->where(['perfile_id' => 5])
                ->toArray();
                if(is_array($rs) && count($rs)>0){

                    foreach ($rs as $row) {
                        //generar contraseña random
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < 7; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }


                        //traer objeto con el id de la fila
                        $persona = $this->personas->get($row['id']);
                        //update de los campos
                        $persona->active = 0;
                        $persona->password = sha1($randomString);
                        //confirmar save
                        $this->personas->save($persona);
                        
                        $nombre_persona = $row['name'].' '.$row['apellido1'].' '.$row['apellido2'];
                        //$textemail = $row['email'];
                        $textemail = 'erictororiquelme@gmail.com';
                        
                        
                        $descripcion['nombre'] = $nombre_persona;
                        $descripcion['email'] = $textemail;
                        $descripcion['username'] = $row['username'];
                        $descripcion['clave'] = $randomString;

                        //$msj_email = $this->correos->enviarcorreo(11, $row['id'],$nombre_persona,$textemail, $descripcion);


                        $result = true;
                        $debug = 'Su usuario y contraseña: El correo electrónico se envió correctamente a "'.$persona->email.'"';
                        //$this->Flash->success(__($debug));
                        $this->Log->write(__($debug),E_NOTICE);
                    }
                }else{
                    $result = false;
                    $debug = 'Olvidó su contraseña: El correo electrónico "'.$textemail.'" no está registrado en el sistema';
                    //$this->Flash->error(__($debug));
                    $this->Log->write(__($debug),E_WARNING);
                }

            }catch (Exception $e) {
                $result = false;
                $debug = 'Excepción capturada: '. $e->getMessage(). "\n";
                $this->Log->write(__($debug),E_ERROR);
                //$this->Flash->error(__($debug));
            }

    }*/

    public function bloquea_usuario($user){
        $this->loadModel('personas');
        $this->loadModel('correos');

        $rs = $this->personas
        ->find()
        ->where(['username' => $user])
        ->toArray();
        if(is_array($rs) && count($rs)>0){
             //traer objeto con el id de la fila
            $persona = $this->personas->get($rs[0]['id']);
            //update de los campos
            $persona->active = 0;
            //confirmar save
            $this->personas->save($persona);
            $descripcion = 'Su cuenta ha sido bloqueada por exceder la cantidad de intentos permitidos';
            $nombre_persona = $rs[0]['name'].' '.$rs[0]['apellido1'].' '.$rs[0]['apellido2'];
            $msj_email = $this->correos->enviarcorreo(4, $rs[0]['id'],$nombre_persona,$rs[0]['email'], $descripcion,0);
			$this->loadModel('Log');
			$this->Log->write(__('Usuario "'.$persona->username.'" bloqueado por nº de intentos.'),E_WARNING);
			$result = (new NotificacionesController())->addNotificacion(null,1,'Usuario "'.$persona->username.'" bloqueado por nº de intentos.');
            $result = (new NotificacionesController())->addNotificacion(null,36,'Usuario "'.$persona->username.'" bloqueado por nº de intentos.');
         
        }
    }

    public function restablecerClave($id){
        $token = isset($_GET['token']) && $_GET['token']!='' ? $_GET['token'] : '';
		$this->loadModel('Log');
		
        $result = false;
        $debug  = false;

        //setear id
        $id = ($id/3);
        if(is_numeric($id)){
            try{
                $this->loadModel('personas');
                    $rs = $this->personas
                    ->find()
                    ->where(['id' => $id, 'active' => 0])
                    ->toArray();
                    if(is_array($rs) && count($rs)>0){
                        $this->set('personas', $rs);
                        $token_bd = md5($rs[0]['id'].$rs[0]['email']);
                        if($token!=$token_bd){
                            $this->redirect('/');
                        }
                    }else{
                        $this->redirect('/');
                    }

                    if($this->request->is('post')){
                        $password_now = isset($this->request->data['password_now']) && $this->request->data['password_now']!='' ? sha1($this->request->data['password_now']) : '';
                        $password_new = isset($this->request->data['password_new']) && $this->request->data['password_new']!='' ? $this->request->data['password_new'] : '';
                        $password_rep = isset($this->request->data['password_rep']) && $this->request->data['password_rep']!='' ? $this->request->data['password_rep'] : '';
                        $validate = $this->request['data']['validate'];
                        //echo $password_new; exit;
   			            if($validate==1){
                            $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
                            $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
                        }elseif(($password_now==$rs[0]['password']) && ($password_new==$password_rep)){
                            $persona = $this->personas->get($rs[0]['id']);
                            //update de los campos
                            $persona->active = 1;
                            $persona->password = sha1($password_new);
                            $persona->error_login = 0;
                            //confirmar save
                            $this->personas->save($persona);
                            $debug = 'La contraseña se actualizó correctamente';
                            $this->Flash->success(__($debug));
							$this->Log->write(__($debug),E_NOTICE);
                            //autenticar en sistema
                            $this->Auth->setUser($rs[0]);
                            //redireccionar
                            //return $this->redirect($this->Auth->redirectUrl());
                            return $this->redirect(['action' => 'ayuda']);

                        }elseif($password_now!=$rs[0]['password']){
                            $debug = 'La contraseña actual no coincide';
                            $this->Flash->error(__($debug));
							$this->Log->write(__($debug),E_WARNING);
                        }elseif($password_new!=$password_rep){
                            $debug = 'La contraseña nueva no coincide';
                            $this->Flash->error(__($debug));
							$this->Log->write(__($debug),E_WARNING);
						}
                        
                    }
                    $result  = true;

            }catch (Exception $e) {
                $result = false;
                $debug = 'Excepción capturada: '. $e->getMessage(). "\n";
                $this->Flash->error(__($debug));
				$this->Log->write(__($debug),E_ERROR);
            }
        }

    }

    public function envioClave(){
        //$this->redirect();
    }
    public function listarRegion(){
        $this->autoRender = false;
        $result = false;
        $debug  = false;

        if($this->request->is('post')){
            
            $paise_id  = isset($_POST['paise_id']) && $_POST['paise_id']!='' ? $_POST['paise_id'] : '';

            $this->loadModel('regiones');
                $paises = $this->regiones
                ->find()
                ->where(['paise_id' => $paise_id])
                ->order(['regiones.name' => 'DESC'])
                ->toArray();
                if(is_array($paises) && count($paises)>0){
                    $result = true;
                }else{
                    $result = false;
                    $debug = 'No se encuentra las regiones asociadas al pais';
                }
        }

         echo json_encode(array('result' => $result, 'debug' => $debug, 'paises' => $paises));
    }

	private function notificacionesHome(){
		$this->session = new Session();
		$idUsuarioActual = $this->session->read('Auth.User.id');
		$notificaciones = null;
		
    if($idUsuarioActual!='' && $idUsuarioActual!=null){
			$this->loadModel('Notificaciones');
			$notificaciones = $this->Notificaciones
				->find('all', array('conditions' => array(
								'Notificaciones.persona_id' => $idUsuarioActual)))
				->order(['Notificaciones.datetime' => 'desc'])
				->limit('7');
			$notificaciones = $notificaciones->toArray();
        }
		return $notificaciones;
    }
    private function hormonas(){
        $this->session = new Session();
        $user_id    = $this->session->read('Auth.User.id');
        $perfile_id = $this->session->read('Auth.User.perfile_id');
        $hormonas   = array();
        $list = [];

        $this->loadModel('hormonas_gestiones');



        if($perfile_id=='4' || $perfile_id=='8'){
            
                
                $hormonass = $this->hormonas_gestiones
                ->find('all')
                ->contain(['Pacientes','Personas', 'Tickets', 'Medicamentos','Presentaciones', 'Medicos', 'HormonasGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('Personas.id' => $user_id))])
                ->order(['hormonas_gestiones.id' => 'desc']);

                $hormonass->where(function ($exp, $q) use ($user_id) {
                    return $exp->like('Personas.id', $user_id);
                });
                //->where(['besidadGestionxenfermeraxnutricionistas.persona_id' => $user_id]);
                foreach ($hormonass as $hormona) {
                    /*if($obesid->obesidad_gestionxenfermeraxnutricionistas[0]->persona_id==$user_id){
                        $list[] = $obesid->ticket_id;
                    }*/
                    $list[] = $hormona->ticket_id;
                   
                }
        
            for ($i=0; $i < count($list); $i++) {
                $hormon = $this->hormonas_gestiones
                ->find('all')
                ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida' => false)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'HormonasGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
                ->where(['hormonas_gestiones.ticket_id' => $list[$i]])
                ->order(['hormonas_gestiones.id' => 'desc'])
                ->toArray();
                
                array_push($hormonas,$hormon[0]);
              
            }
        }else{
            $hormonas = $this->hormonas_gestiones
            ->find('all', array('limit' => 7))
            ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida <>' => true)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'HormonasGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
            ->order(['hormonas_gestiones.ticket_id' => 'desc']);
       }
        return $hormonas;
    }

    private function diabetes(){
        $this->session = new Session();
        $user_id    = $this->session->read('Auth.User.id');
        $perfile_id = $this->session->read('Auth.User.perfile_id');
        $diabetes   = array();
        $list = [];

        $this->loadModel('diabetes_gestiones');



        if($perfile_id=='4' or $perfile_id=='8'){
            
                
                $diabetess = $this->diabetes_gestiones
                ->find('all')
                ->contain(['Pacientes','Personas', 'Tickets', 'Medicamentos','Presentaciones', 'Medicos', 'DiabetesGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('Personas.id' => $user_id))])
                ->order(['diabetes_gestiones.id' => 'desc']);

                $diabetess->where(function ($exp, $q) use ($user_id) {
                    return $exp->like('Personas.id', $user_id);
                });

                //->where(['besidadGestionxenfermeraxnutricionistas.persona_id' => $user_id]);
                foreach ($diabetess as $diabete) {
                    /*if($obesid->obesidad_gestionxenfermeraxnutricionistas[0]->persona_id==$user_id){
                        $list[] = $obesid->ticket_id;
                    }*/
                  
                    $list[] = $diabete->ticket_id;

                }
        
            for ($i=0; $i < count($list); $i++) {
                $diabet = $this->diabetes_gestiones
                ->find('all')
                 ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida' => false)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'DiabetesGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
                ->where(['diabetes_gestiones.ticket_id' => $list[$i]])
                ->order(['diabetes_gestiones.ticket_id' => 'desc'])
                ->toArray();

                array_push($diabetes,$diabet[0]);
            }
        }else{
            $diabetes = $this->diabetes_gestiones
            ->find('all', array('limit' => 7))
            ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida <>' => true)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'DiabetesGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
            ->order(['diabetes_gestiones.ticket_id' => 'DESC']);
       }

        return $diabetes;
    }
    private function obesidad(){
        $this->session = new Session();
        $user_id    = $this->session->read('Auth.User.id');
        $perfile_id = $this->session->read('Auth.User.perfile_id');
        $obesidad   = array();
        $list = [];

        $this->loadModel('obesidad_gestiones');



        if($perfile_id=='4' || $perfile_id=='8'){
            
                
                $obesidd = $this->obesidad_gestiones
                ->find('all')
                ->contain(['Pacientes','Personas', 'Tickets', 'Medicamentos','Presentaciones', 'Medicos', 'ObesidadGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('Personas.id' => $user_id))])
                ->order(['obesidad_gestiones.id' => 'desc']);

                $obesidd->where(function ($exp, $q) use ($user_id) {
                    return $exp->like('Personas.id', $user_id);
                });
                //->where(['besidadGestionxenfermeraxnutricionistas.persona_id' => $user_id]);
                foreach ($obesidd as $obesid) {
                    /*if($obesid->obesidad_gestionxenfermeraxnutricionistas[0]->persona_id==$user_id){
                        $list[] = $obesid->ticket_id;
                    }*/
                    $list[] = $obesid->ticket_id;
                }
        
            for ($i=0; $i < count($list); $i++) {
                $obesi = $this->obesidad_gestiones
                ->find('all')
                ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida' => false)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'ObesidadGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
                ->where(['obesidad_gestiones.ticket_id' => $list[$i]])
                ->order(['obesidad_gestiones.id' => 'desc'])
                ->toArray();
                array_push($obesidad,$obesi[0]);
            }
        }else{
            $obesidad = $this->obesidad_gestiones
            ->find('all', array('limit' => 7))
            ->contain(['Pacientes','Personas', 'Tickets' => array( 'Notificaciones' => array('conditions' => array('leida <>' => true)), 'Ticketsxestados'=> array('EstadosTickets')), 'Medicamentos','Presentaciones', 'Medicos', 'ObesidadGestionxenfermeraxnutricionistas' => array('Personas','conditions' => array('datetime_inicio <=' => date('c')))])
            ->order(['obesidad_gestiones.ticket_id' => 'DESC']);
       }
        return $obesidad;
    }

    public function diabetesObesidad()
    {
        $this->session = new Session();
        $perfile_id = $this->session->read('Auth.User.perfile_id');
        $diabetesObesidad = array();
        $diabetes = $this->diabetes();
        $obesidad = $this->obesidad();
        $hormonas = $this->hormonas();

        if ($perfile_id != 12) {
         array_push($diabetesObesidad,$diabetes,$obesidad,$hormonas);   
        } else {
         array_push($diabetesObesidad,$hormonas);            
        }
        return $diabetesObesidad;
    }

    public function indexEnfermera()
    {
        $personas = $this->Personas->find('all', array('contain' =>['Tipospersonas','Perfiles']))->where(['tipospersona_id'=>'4','perfile_id' => '4'])->orwhere(['tipospersona_id'=>'3','perfile_id' => '4']);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }
    public function addEnfermera()
    {
        $this->loadModel('Log');
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $validate = $this->request['data']['validate'];
            if($validate==1){
                $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
                $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
            }else if($this->request->data['password']!=$this->request->data['confirm_password']){
                $this->Flash->error(__('La contraseña no coincide.'));
                $this->Log->write('La contraseña no coincide.',E_WARNING);
            }else if($this->request->data['password']==""){
                $this->Flash->error(__('Debe rellenar las contraseñas.'));
                $this->Log->write('Debe rellenar las contraseñas.',E_WARNING);
            }else{
                $persona = $this->Personas->patchEntity($persona, $this->request->data);
                $persona->password=sha1($this->request->data['password']);
                if ($this->Personas->save($persona)) {
                    $this->recuperarClaveCall($persona->id,$persona->perfile_id);                    
                    $this->Log->write('Se ha creado correctamente el nuevo usuario "'.$this->request->data['name'].'".',E_NOTICE);
                    $this->Flash->success(__('Se ha creado correctamente el nuevo usuario "'.$this->request->data['name'].'".'));

                    return $this->redirect(['action' => 'indexEnfermera']);
                } else {
                	 //echo "<div class=\"casa\"></div>";
                    $this->Flash->error(__('El usuario "'.$this->request->data['name'].'" no se ha podido crear. Por favor, inténtelo de nuevo.'));
                   	//$this->Log->write('El usuario "'.$this->request->data['username'].'" no se ha podido crear. Por favor, inténtelo de nuevo.',E_WARNING);
               }
            }       
        }
        $paises = $this->Personas->Paises->find('list', ['limit' => 200]);
        $regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
        $ciudades = $this->Personas->Ciudades->find('list', ['limit' => 200]);
        $comunas = $this->Personas->Comunas->find('list', ['limit' => 200]);
        $perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200])->where(['id' => 4]);
        $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200])->where(['id' => 3])/*->orwhere(['id' => 4])*/;
        $this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'perfiles', 'tipospersonas', 'comunas'));
        $this->set('_serialize', ['persona']);
    }
    public function editEnfermera($id = null)
    {
        $this->loadModel('Log');
        $persona = $this->Personas->get($id, [
            'contain' => []
        ]);
        $passwordOriginal= $persona->password;
        $persona->password="";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $validate = $this->request['data']['validate'];
            if($validate==1){
                $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
                $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
            }else if($this->request->data['password']!=$this->request->data['confirm_password']){
                $this->Flash->error(__('La contraseña no coincide.'));
                $this->Log->write('La contraseña no coincide.',E_WARNING);
            }else{
                 $persona = $this->Personas->patchEntity($persona, $this->request->data);
                if ($this->request->data['password']=="") {
                    $persona->password=$passwordOriginal;
                   
                }
                else {
                    $persona->password=sha1($this->request->data['password']);
                    if ($this->request->data['active']==1){
                        $persona->error_login=0;
                    }
            }
                if ($this->Personas->save($persona)) {
                    $this->Flash->success(__('Se ha modificado correctamente el usuario "'.$this->request->data['username'].'".'));
                    $this->Log->write(__('Se ha modificado correctamente el usuario "'.$this->request->data['username'].'".'),E_NOTICE);

                    return $this->redirect(['action' => 'indexEnfermera']);
                } else {
                    $this->Flash->error(__('El usuario "'.$this->request->data['username'].'" no se ha podido modificado. Por favor, inténtelo de nuevo.'));
                    $this->Log->write('El usuario "'.$this->request->data['username'].'" no se ha podido modificado. Por favor, inténtelo de nuevo.',E_WARNING);
                }
            }
        }
        $paises = $this->Personas->Paises->find('list', ['limit' => 200]);
        $regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
        $ciudades = $this->Personas->Ciudades->find('list', ['limit' => 200]);
        $comunas = $this->Personas->Comunas->find('list', ['limit' => 200]);
        $perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200])->where(['id' => '4']);
        $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200])->where(['id' => '3'])/*->orwhere(['id' => 4])*/;
        $this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'comunas','perfiles', 'tipospersonas'));
        $this->set('_serialize', ['persona']);
    }
    public function activeEnfermera($id = null)
    {
        $this->loadModel('Log');
        $mensajeOK = '';
        $mensajeKO = '';
        $this->request->allowMethod(['get']);
        $persona = $this->Personas->get($id);
        if($persona->active == 1){
            $persona->active = 0;
            $mensajeOK = 'Se ha desactivado al usuario "'.$persona->username.'".';
            $mensajeKO = 'No se ha podido desactivar al usuario "'.$persona->username.'".';
        } else {
            $persona->active = 1;
             $persona->error_login = 0;
            $mensajeOK = 'Se ha activado al usuario "'.$persona->username.'".';
            $mensajeKO = 'No se ha podido activar al usuario "'.$persona->username.'".';
            $this->loadModel('correos');
            $descripcion = 'Su cuenta en la plataforma Centro NovoCare ha sido activada. Puede acceder utilizando sus credenciales o si no recuerda su contraseña puede utilizar el enlace "¿Olvidó su contraseña?" que se encuentra en la pantalla de identificación de la plataforma.';
            $nombre_persona = $persona->name.' '.$persona->apellido1.' '.$persona->apellido2;
            $persona_email = $persona->email;
            $msj_email = $this->correos->enviarcorreo(3, $id,$nombre_persona,$persona_email, $descripcion);
        }
        if ($this->Personas->save($persona)) {
            $this->Flash->success(__($mensajeOK));
            $this->Log->write(__($mensajeOK),E_NOTICE);
        } else {
            $this->Flash->error(__($mensajeKO));
            $this->Log->write(__($mensajeKO),E_WARNING);
        }

        return $this->redirect(['action' => 'indexEnfermera']);
    }


    public function activeMedico($id = null)
    {
        $this->loadModel('Log');
        $mensajeOK = '';
        $mensajeKO = '';
        $this->request->allowMethod(['get']);
        $persona = $this->Personas->get($id);
        if($persona->active == 1){
            $persona->active = 0;
            $mensajeOK = 'Se ha desactivado al médico " '.$persona->name.' '.$persona->apellido1.' '.$persona->apellido2.' ".';
            $mensajeKO = 'No se ha podido desactivar al médico " '.$persona->name.' '.$persona->apellido1.' '.$persona->apellido2.' ".';
        } else {
            $persona->active = 1;
            $mensajeOK = 'Se ha activado al médico " '.$persona->name.' '.$persona->apellido1.' '.$persona->apellido2.' ".';
            $mensajeKO = 'No se ha podido activar al médico " '.$persona->name.' '.$persona->apellido1.' '.$persona->apellido2.' ".';
            $this->loadModel('correos');
            $descripcion = 'Su cuenta en la plataforma Centro NovoCare ha sido activada. Puede acceder utilizando sus credenciales o si no recuerda su contraseña puede utilizar el enlace "¿Olvidó su contraseña?" que se encuentra en la pantalla de identificación de la plataforma.';
            $nombre_persona = $persona->name.' '.$persona->apellido1.' '.$persona->apellido2;
            $persona_email = $persona->email;
            $msj_email = $this->correos->enviarcorreo(3, $id,$nombre_persona,$persona_email, $descripcion);
        }
        if ($this->Personas->save($persona)) {
            $this->Flash->success(__($mensajeOK));
            $this->Log->write(__($mensajeOK),E_NOTICE);
        } else {
            $this->Flash->error(__($mensajeKO));
            $this->Log->write(__($mensajeKO),E_WARNING);
        }

        return $this->redirect(['action' => 'indexMedico']);
    }
	public function indexMedico () {
		$this->session = new Session();
		$perfile_id = $this->session->read('Auth.User.perfile_id');
		$personas = $this->Personas
			->find('all', array('contain' =>['Tipospersonas','Perfiles']))
			->contain(['Paises', 'Regiones', 'Ciudades', 'Perfiles', 'Tipospersonas', 'DatosControlPacientes', 'ObesidadComentarios', 'ObesidadEventoAdversos', 'ObesidadGestiones', 'ObesidadGestionxenfermeraxnutricionistas', 'ObesidadRegistroContactos', 'Representantesxmedicos', 'Tickets'])
			->where(['tipospersona_id'=>'2','perfile_id' => '6'])
            ->order(['Personas.id' => 'DESC']);
		$this->set(compact('personas'));
		$this->set('_serialize', ['personas']);

		$this->loadModel('representantesxmedicos');
		$representantesxmedicos = $this->representantesxmedicos
			->find('all')
			->contain(['Personas' => array('Paises', 'Regiones', 'Ciudades'), 'Representantes']);

		$this->set(compact('representantesxmedicos', 'personas','perfile_id'));
		$this->set('_serialize', ['representantesxmedicos']);
	}
public function addMedico (){
	$this->loadModel('Log');
    $idmedicos = false;
    $data_representante = array();
	$persona = $this->Personas->newEntity();
	if ($this->request->is('post')) {
		if(isset($this->request['data']['validate'])) {
			$validate = $this->request['data']['validate'];
		}
		else{
			$validate =0;
		}
		if($validate==1) {
			$this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
			$this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
		}
		elseif($this->request->data['password']!=$this->request->data['confirm_password']){
			$this->Flash->error(__('La contraseña no coincide.'));
			$this->Log->write('La contraseña no coincide.',E_WARNING);
		}
		elseif($this->request->data['password']==""){
			$this->Flash->error(__('Debe rellenar las contraseñas.'));
			$this->Log->write('Debe rellenar las contraseñas.',E_WARNING);
		}
		else{
			$persona = $this->Personas->patchEntity($persona, $this->request->data);
			$persona->password=sha1($this->request->data['password']);
            $persona->consentimiento_correos = $this->request['data']['consentimiento_correos']['name'];
			if ($this->Personas->save($persona)) {
                $idmedicos = $persona->id;
                $this->loadModel('Representantesxmedicos');
                $representantesxmedicos = $this->Representantesxmedicos->newEntity();
                $data_representante['persona_id'] = $idmedicos;
                $data_representante['representante_id'] = $this->request->data['representante_id'];
                $data_representante['datetime_inicio'] = date('Y-m-d');
                //var_dump($this->request['data']['consentimiento_correos']['name']); die;
                $representantesxmedicos = $this->Representantesxmedicos->patchEntity($representantesxmedicos, $data_representante);
                if($this->Representantesxmedicos->save($representantesxmedicos)){
                    $Uploads = new UploadsController;  
                    if (isset($this->request['data']['consentimiento_correos']) && $this->request['data']['consentimiento_correos']['name']!="") {
                        $consentimiento_expreso  = $this->request['data']['consentimiento_correos'];
                        $resultadoSubida = $Uploads->compruebaFichero($consentimiento_expreso);
                        //var_dump($resultadoSubida); die;
                        if (!$resultadoSubida[0]){
                            $this->Flash->error($resultadoSubida[1]);
                            //return $this->request['data'];
                        } 
                        $consentimiento_expreso  = $Uploads->subidaArchivo($idmedicos,'consentimiento_correos',$consentimiento_expreso);
                    } else {
                        $consentimiento_expreso  = "";
                    }
                }
                $this->Log->write('Se ha creado correctamente el nuevo usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'".',E_NOTICE);
                $this->Flash->success(__('Se ha creado correctamente el nuevo usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'".'));
                return $this->redirect(['action' => 'index-medico']);
			}
			else {
				$this->Flash->error(__('El usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'" no se ha podido crear. Por favor, inténtelo de nuevo.'));
				$this->Log->write('El usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'" no se ha podido crear. Por favor, inténtelo de nuevo.',E_WARNING);
			}
		}
	}
	$paises = $this->Personas->Paises->find('list', ['limit' => 200])->order(['id' => 'ASC']);
	$regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
	$perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200]);
    $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200]);
	//$representantes = $this->Personas->Representantesxmedicos->find('list', ['limit' => 200]);
	$this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'perfiles', 'tipospersonas', 'representantesxmedicos'));
	$this->set('_serialize', ['persona']);
    $this->loadModel('representantes');
    $representantesx = $this->representantes
    ->find('all');
    $this->set(compact('representantesx'));
    $this->set('_serialize', ['representantesx']);
    if ($this->request->is('post')) {
    }
}
	public function editMedico($id = null)
	{
    $this->loadModel('Log');
    $idmedicos = false;
    $data_representante = array();
    $persona = $this->Personas->newEntity();
    $persona = $this->Personas->get($id, ['contain' => []]);
/**/
        $idmedicos = $persona->id;
        $this->loadModel('representantesxmedicos');
        $representantesxmedicos = $this->representantesxmedicos
            ->find('all')
            ->where(['representantesxmedicos.persona_id' => $idmedicos])
            ->order('representantesxmedicos.id DESC')
            ->limit(1)
            ->contain(['Representantes'])
            ->toArray();
        $this->set(compact('representantesxmedicos', 'representantesxmedicos'));
        $this->set('_serialize', ['representantesxmedicos']);
/**/
    if ($this->request->is(['patch', 'post', 'put'])) {
        if(isset($this->request['data']['validate'])) {
            $validate = $this->request['data']['validate'];
        }
        else{
            $validate =0;
        }
        if($validate==1) {
            $this->Flash->error(__('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.'));
            $this->Log->write('La contraseña no cumple con los requisitos minimos de seguridad. Por favor, inténtelo de nuevo.',E_WARNING);
        }
        else if($this->request->data['password']!=$this->request->data['confirm_password']){
            $this->Flash->error(__('La contraseña no coincide.'));
            $this->Log->write('La contraseña no coincide.',E_WARNING);
        }
        else if($this->request->data['password']==""){
            $this->Flash->error(__('Debe rellenar las contraseñas.'));
            $this->Log->write('Debe rellenar las contraseñas.',E_WARNING);
        }
        else{
            $persona = $this->Personas->patchEntity($persona, $this->request->data);
            $persona->password=sha1($this->request->data['password']);
            $persona->consentimiento_correos = $this->request['data']['consentimiento_correos']['name'];
            if ($this->Personas->save($persona)) {
                $idmedicos = $persona->id;
                $this->loadModel('Representantesxmedicos');
                $representantesxmedicos = $this->Representantesxmedicos->newEntity();
                $data_representante['persona_id'] = $idmedicos;
                $data_representante['representante_id'] = $this->request->data['representante_id'];
                $data_representante['datetime_inicio'] = date('Y-m-d');
                //var_dump($this->request['data']['consentimiento_correos']['name']); die;
                $representantesxmedicos = $this->Representantesxmedicos->patchEntity($representantesxmedicos, $data_representante);
                if($this->Representantesxmedicos->save($representantesxmedicos)){
                    $Uploads = new UploadsController;  
                    if (isset($this->request['data']['consentimiento_correos']) && $this->request['data']['consentimiento_correos']['name']!="") {
                        $consentimiento_expreso  = $this->request['data']['consentimiento_correos'];
                        $resultadoSubida = $Uploads->compruebaFichero($consentimiento_expreso);
                        //var_dump($resultadoSubida); die;
                        if (!$resultadoSubida[0]){
                            $this->Flash->error($resultadoSubida[1]);
                            //return $this->request['data'];
                        } 
                        $consentimiento_expreso  = $Uploads->subidaArchivo($idmedicos,'consentimiento_correos',$consentimiento_expreso);
                    } else {
                        $consentimiento_expreso  = "";
                    }
                }
                $this->Log->write('Se ha modificado correctamente el nuevo usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'".',E_NOTICE);
                $this->Flash->success(__('Se ha modificado correctamente el nuevo usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'".'));
                return $this->redirect(['action' => 'index-medico']);
            }
            else {
                $this->Flash->error(__('El usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'" no se ha podido modificar. Por favor, inténtelo de nuevo.'));
                $this->Log->write('El usuario "'.$this->request->data['name'].' '.$this->request->data['apellido1'].' '.$this->request->data['apellido2'].'" no se ha podido modificar. Por favor, inténtelo de nuevo.',E_WARNING);
            }
        }
    }
    $paises = $this->Personas->Paises->find('list', ['limit' => 200])->order(['id' => 'ASC']);
    $regiones = $this->Personas->Regiones->find('list', ['limit' => 200]);
    $perfiles = $this->Personas->Perfiles->find('list', ['limit' => 200]);
    $tipospersonas = $this->Personas->Tipospersonas->find('list', ['limit' => 200]);
    //$representantes = $this->Personas->Representantesxmedicos->find('list', ['limit' => 200])->where(['persona_id'=>$idmedicos]);
    $this->set(compact('persona', 'paises', 'regiones', 'ciudades', 'perfiles', 'tipospersonas', 'representantesxmedicos','representantes'));
    $this->set('_serialize', ['persona']);
    $this->loadModel('representantes');
    $representantesx = $this->representantes
    ->find('all')->toArray();
    $this->set(compact('representantesx'));
    $this->set('_serialize', ['representantesx']);
    if ($this->request->is('post')) {
    }
}       
}