<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Convocatorias Controller
 *
 * @property \App\Model\Table\ConvocatoriasTable $Convocatorias
 *
 * @method \App\Model\Entity\Convocatoria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConvocatoriasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
		
		$where = "";
		
		// FILTROS:
			if(isset($_GET['estado']))
			{
				if($_GET['estado'] == 'Visible')
				{
					$where = '(Convocatorias.Visible = 1)';

				}else if ($_GET['estado'] == 'Invisible')
				{
					$where = '(Convocatorias.Visible = 0)';

				}else if ($_GET['estado'] == 'Todos')
				{
					$where = '(Convocatorias.Visible = 0 OR Convocatorias.Visible = 1)';
				}	
			}
		
		    if (isset($_GET['termino'])) {
				$where .= ' AND (Convocatorias.Nombre LIKE "%'.$_GET['termino'].'%")';
        	}
		
		// Fin FILTROS:
		
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
							->where(['perfil_acciones.Perfile_id='.$this->request->getSession()->read('Auth.User.Perfile_id').' AND acciones.controlador="convocatorias" AND acciones.metodo="index"'])
							->toArray();

			if ($query['0']['perfil_acciones']['accione_id'] == 22) {
				$where = "(Usuarios.Perfile_id IN (2,3,4) AND Usuarios.Empresa_id=".$this->request->getSession()->read('Auth.User.Empresa_id').")";
				
				if(isset($_GET['estado']))
				{
					if($_GET['estado'] == 'Visible')
					{
						$where .= 'AND (Convocatorias.Visible = 1)';

					}else if ($_GET['estado'] == 'Invisible')
					{
						$where .= 'AND (Convocatorias.Visible = 0)';

					}else if ($_GET['estado'] == 'Todos')
					{
						$where .= 'AND (Convocatorias.Visible = 0 OR Convocatorias.Visible = 1)';
					}	
				}

				if (isset($_GET['termino'])) {
					$where .= ' AND (Convocatorias.Nombre LIKE "%'.$_GET['termino'].'%")';
				}
			}
		}	
		
        $convocatorias = $this->Convocatorias->find('all') 
        ->where($where);
                    
        $this->set('Convocatorias', $this->paginate($convocatorias));
        $this->set(compact('convocatorias'));
		
    }

    /**
     * View method
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $convocatoria = $this->Convocatorias->get($id, [
            'contain' => ['Usuarios']
        ]);

        $this->loadModel('Archivossubidos');
        $archivossubidos = $this->Archivossubidos->find('all')
        ->where(['convocatoria_id' => $id])
        ->toArray();

        $this->loadModel('Categorias');
        $categorias = $this->Categorias->find('all')
        ->where(['convocatoria_id' => $id])
        ->toArray();
        
        $this->loadModel('Meritos');
        $meritos = $this->Meritos
            ->find('all')
            ->join([
				'categorias' => [
					'table' => 'categorias',
					'type' => 'inner',
					'conditions' => 'Meritos.categoria_id = categorias.id']
					])
            ->select(['Meritos.id', 'Meritos.Descripcion', 'Meritos.Puntuacion', 'Meritos.tipos_meritos_id', 'categorias.Descripcion'])
            ->where(['Meritos.convocatoria_id' => $id])
            ->toArray();
        
		
		$this->loadModel('Requisitos');
        $requisitos = $this->Requisitos->find('all')
        ->where(['convocatoria_id' => $id])
        ->toArray();

		$this->loadModel('Solicitudes');
        $evaluados = $this->Solicitudes->find('all');
        $evaluados->select(['Solicitudes.id'])
                  ->where(['Solicitudes.convocatoria_id ='.$id.' AND Solicitudes.FechaEvaluacion IS NOT NULL;']);
        $this->set('evaluados', $evaluados);
        
        $noevaluados = $this->Solicitudes->find('all');
        $noevaluados->select(['Solicitudes.id'])
                    ->where(['Solicitudes.convocatoria_id ='.$id.' AND Solicitudes.aceptado IS NULL AND Solicitudes.fechaEvaluacion IS NULL;']);
        $this->set('noevaluados', $noevaluados);
        
        $aceptados = $this->Solicitudes->find('all');
        $aceptados->select(['Solicitudes.id'])
                    ->where(['Solicitudes.convocatoria_id ='.$id.' AND Solicitudes.aceptado = 1;']);
        $this->set('aceptados', $aceptados);        

        $this->set(compact('archivossubidos','categorias','meritos','requisitos','usuarios'));
        $this->set('convocatoria', $convocatoria);
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $convocatoria = $this->Convocatorias->newEntity();
			
 		if ($this->request->is('post')) {
            //----------------  VALIDATE => FALSE PARA QUITAR LAS VALIDACIONES ----------------
            $convocatoria = $this->Convocatorias->patchEntity($convocatoria, $this->request->getData(),['validate' => false]);
					
			$email = new Email('default');
			$correo = $this->Auth->user('Email');
			
			/*
			 * PORTILLO
			 *
			 * Asignamos la fecha de creación manualmente. !IMPORTANTE, LA FECHA TIENE QUE ESTÁR ASI, SI NO NO LA COGE LA BBDD!
			 * Asignamos el usuario que crea la convocatoria. (El usuario que está logueado).
			 *
			*/ 
			
			$convocatoria['FechaCreacion'] = date("Y-m-d H:i:s");
			$convocatoria['Usuario_id'] = $this->Auth->user('id');
			
            if ($this->Convocatorias->save($convocatoria)) {
                
                try {
                      $email->to($correo)
                        ->subject('Convocatoria')
						->send($this->Auth->user('Nombre') . ", tu convocatoria ha quedado registrada en el sistema.");
						
				} catch (Exception $e){					
					$this->Flash->error(__('Error al enviar email: ' . $e->getMessage()));
				}
				
                return $this->redirect(['action' => 'index','success_add' => 1]);
            }
            $fail_add = 'La convocatoria no ha podido guardarse. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
						
        }
		
        $usuarios = $this->Convocatorias->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('convocatoria', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
		//SEGURIDAD URL PARA QUE NO PUEDAN EDITAR IDs DE OTROS USUARIOS CAMBIANDO EL ID EN LA URL
		$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $urlArray);
		$numSegments = count($segments); 
		$currentSegment = $segments[$numSegments - 1]; 

		$user_id_perfil = $this->request->getSession()->read('Auth.User.Perfile_id');
		$user_id_empresa = $this->request->getSession()->read('Auth.User.Empresa_id');	
		
		if(($user_id_perfil == 1) || ($user_id_perfil == 2))
		{	
			if($user_id_perfil == 2)
			{
				$val = false;
				$query = $this->Convocatorias
					->find('all')
					->join([
						'usuarios' => [
							'table' => 'usuarios',
							'type' => 'inner',
							'conditions' => 'Convocatorias.Usuario_id = usuarios.id'],
						'empresas' => [
							'table' => 'empresas',
							'type' => 'inner',
							'conditions' => 'usuarios.Empresa_id = empresas.id']
						])
					->select(['Convocatorias.id'])
					->where(['empresas.id ='.$this->request->getSession()->read('Auth.User.Empresa_id')])
					->toArray();	
				
				for($i=0; $i<count($query); $i++)
				{
					if($query[$i]['id'] == $currentSegment)
					{
						$val = true;
					} 
				}
				
				if($val == false)
				{
					return $this->redirect(['controller' => 'error','action' => 'permisos']);
				}
				
			}
		
			$convocatoria = $this->Convocatorias->get($id, [
				'contain' => []
			]);

			if ($this->request->is(['patch', 'post', 'put'])) {	
				//----------------  VALIDATE => FALSE PARA QUITAR LAS VALIDACIONES ----------------
				$convocatoria = $this->Convocatorias->patchEntity($convocatoria, $this->request->getData(),['validate' => false]);
				if ($this->Convocatorias->save($convocatoria)) {

					return $this->redirect(['action' => 'index','success_edit' => 1]);
				}
				$fail_edit = 'La convocatoria no ha podido guardarse. Por favor, intentelo de nuevo.';
				$this->set(compact('fail_edit'));
			}
			$usuarios = $this->Convocatorias->Usuarios->find('list', ['limit' => 200]);
			$this->set(compact('convocatoria', 'usuarios'));
		}
	}

    /**
     * Delete method
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
		
		$perfil_user = $this->request->getSession()->read('Auth.User.Perfile_id');
		
        if (($perfil_user == 4) || ($perfil_user == 5)) {
            return $this->redirect(['controller' => 'error','action' => 'permisos']);
        }


        $this->request->allowMethod(['post', 'delete']);
        $convocatoria = $this->Convocatorias->get($id);
		
		$this->loadModel('Meritos');
        $this->Meritos->deleteAll(['convocatoria_id' => $id]);
		
		$this->loadModel('Categorias');
        $this->Categorias->deleteAll(['convocatoria_id' => $id]);
		
		$this->loadModel('Requisitos');
        $this->Requisitos->deleteAll(['convocatoria_id' => $id]);
		
		$this->loadModel('Archivossubidos');
        $this->Archivossubidos->deleteAll(['convocatoria_id' => $id]);	

			
        if ($this->Convocatorias->delete($convocatoria)) {
            return $this->redirect(['action' => 'index','success_delete' => 1]);
        } else {
            return $this->redirect(['action' => 'index','fail_delete' => 1]);
        }

        //return $this->redirect(['action' => 'index']);
    }
    
/*---------------------------------------------SOLICITANTE---------------------------------------------*/   
    
    /**
     * listar method for solicitantes
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function listar() {

        $this->paginate = [
            'contain' => ['Usuarios']
        ];
		
		$where = "";	
		// FILTROS:		
        if (isset($_GET['termino'])) {
            $where .= ' AND (Convocatorias.Nombre LIKE "%'.$_GET['termino'].'%")';
        }
		// Fin FILTROS:
		
        $convocatorias = $this->Convocatorias
        ->find('all')
        ->join([
            'usuarios' => [
                'table' => 'usuarios',
                'type' => 'inner',
                'conditions' => 'Convocatorias.Usuario_id = usuarios.id']
            ])
        ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (Visible = 1)'.$where.';']) 
        ->toArray();
        
        $this->set(compact('convocatorias'));
    } 
    
    /**
     * admitidos method for Convocatorias
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function admitidos($id = null) {
        
        $convocatoria = $this->Convocatorias->get($id, [
		  'contain' => []
		]);
        $this->set('convocatoria', $convocatoria);

        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        
        if (isset($id)) {
            $this->set('id', $id);
        }
        
		$where = "";	
		// FILTROS:		
        if(isset($_GET['termino']) && ($_GET['termino'] != "")) {
            $where .= ' AND (Usuarios.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Apellidos LIKE "%'.$_GET['termino'].'%" OR Usuarios.Dni LIKE "%'.$_GET['termino'].'%" OR Usuarios.Email LIKE "%'.$_GET['termino'].'%")';
        }
		// Fin FILTROS:
        
		$this->loadModel('Solicitudes');
        $solicitudes = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'Usuarios' => [
                    'table' => 'Usuarios',
                    'type' => 'inner',
                    'conditions' => 'Usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'convocatorias.Nombre', 'Usuarios.Nombre', 'Usuarios.Apellidos', 'Usuarios.Telefono', 'Solicitudes.aceptado'])
             ->where(['Usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.aceptado = 1)'.$where]);
        $this->set('solicitudes', $this->paginate($solicitudes));
        
        $admitidos = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'convocatorias.Nombre', 'usuarios.Nombre', 'usuarios.Apellidos', 'usuarios.Telefono', 'Solicitudes.aceptado'])
             ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.aceptado = 1)']);
        $this->set('admitidos', $admitidos);
        
        $noadmitidos = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'convocatorias.Nombre', 'usuarios.Nombre', 'usuarios.Apellidos', 'usuarios.Telefono', 'Solicitudes.aceptado'])
             ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.aceptado = 0)']);
        $this->set('noadmitidos', $noadmitidos);
        
        $exclusionmotivos = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'requisitos' => [
                    'table' => 'requisitos',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = requisitos.convocatoria_id'],
                'solicitud_has_requisitos' => [
                    'table' => 'solicitud_has_requisitos',
                    'type' => 'inner',
                    'conditions' => ['solicitud_has_requisitos.requisito_id = requisitos.id', 'solicitud_has_requisitos.solicitude_id = Solicitudes.id']],                
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'requisitos.id', 'requisitos.motivo_exclusion', 'solicitud_has_requisitos.id', 'solicitud_has_requisitos.valido'])
             ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.aceptado = 0) AND (solicitud_has_requisitos.valido = 0)']);
             //->toArray();
        $this->set('exclusionmotivos', $exclusionmotivos);           
        
    }
    
    /**
     * evaluados method for Convocatorias
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function evaluados($id = null) {
        
        $convocatoria = $this->Convocatorias->get($id, [
		  'contain' => []
		]);
        $this->set('convocatoria', $convocatoria);

        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        
        if (isset($id)) {
            $this->set('id', $id);
        }
        
		$where = "";	
		// FILTROS:		
        if(isset($_GET['termino']) && ($_GET['termino'] != "")) {
            $where .= ' AND (Usuarios.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Apellidos LIKE "%'.$_GET['termino'].'%" OR Usuarios.Dni LIKE "%'.$_GET['termino'].'%" OR Usuarios.Email LIKE "%'.$_GET['termino'].'%")';
        }
		// Fin FILTROS:
        
		$this->loadModel('Solicitudes');
        $solicitudes = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'Usuarios' => [
                    'table' => 'Usuarios',
                    'type' => 'inner',
                    'conditions' => 'Usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'convocatorias.Nombre', 'Usuarios.Nombre', 'Usuarios.Apellidos', 'Usuarios.Telefono', 'convocatorias.ListadoAdmitidos', 'Solicitudes.puntuacionEvaluacion' ,'Solicitudes.puntuacionConocimiento', 'Solicitudes.puntuacionPsicotecnico', 'Solicitudes.puntuacionEntrevista'])
             ->where(['Usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.puntuacionEvaluacion IS NOT NULL)'.$where]);
        $this->set('solicitudes', $this->paginate($solicitudes)); 
        
        $evaluados = $this->Solicitudes
            ->find('all')
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'convocatorias.id', 'convocatorias.Nombre', 'usuarios.Nombre', 'usuarios.Apellidos', 'usuarios.Telefono', 'convocatorias.ListadoAdmitidos', 'Solicitudes.puntuacionEvaluacion' ,'Solicitudes.puntuacionConocimiento', 'Solicitudes.puntuacionPsicotecnico', 'Solicitudes.puntuacionEntrevista'])
             ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (Solicitudes.puntuacionEvaluacion IS NOT NULL)']);
        $this->set('evaluados', $evaluados);        
    }
    
    /**
     * publicaradmitidos method for Convocatorias. AJAX
     *
     * @param string|null $id Convocatoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    
    public function publicaradmitidos(){
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        
        if ($this->request->is('post')) {
            
            $convocatorias = TableRegistry::get('Convocatorias'); 
            $convocatoria = $convocatorias->get($_POST['id_convocatoria']); 
            
            $convocatoria->ListadoAdmitidos = 1;
            
            if($convocatorias->save($convocatoria)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    public function publicarevaluados(){
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        
        if ($this->request->is('post')) {
            
            $convocatorias = TableRegistry::get('Convocatorias'); 
            $convocatoria = $convocatorias->get($_POST['id_convocatoria']); 
            
            $convocatoria->ListadoEvaluados = 1;
            
            if($convocatorias->save($convocatoria)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    /**
     * Exportar csv admitidos. AHORA MISMO NO ESTÁ EN FUNCIONAMIENTO
     */
    
    public function exportadmitidos($id = null) {
		$this->response->download('export.csv');
        
		$this->loadModel('Usuarios');
        $data = $this->Usuarios
            ->find('all')
            ->join([
                'solicitudes' => [
                    'table' => 'solicitudes',
                    'type' => 'inner',
                    'conditions' => 'Usuarios.id = solicitudes.usuario_solicitante'],
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = solicitudes.convocatoria_id']                
                ])
             ->select(['Usuarios.id', 'Usuarios.Nombre', 'Usuarios.Apellidos', 'Usuarios.Dni', 'Usuarios.Direccion', 'Usuarios.Email', 'Usuarios.Telefono', 'Usuarios.Localidad', 'Usuarios.Cp'])
             ->where(['Usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (solicitudes.aceptado = 1);'])
             ->toArray();

		$_serialize = 'data';
        $_header = ['ID', 'Nombre', 'Apellidos', 'DNI', 'Direccion', 'Email', 'Telefono', 'Localidad', 'C.P.'];
        //$_extract = ['ID', 'Nombre', 'Apellidos', 'Dni', 'Direccion', 'Email', 'Telefono', 'Localidad', 'Cp'];
   		//$this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->set(compact('data', '_serialize', '_header'));
		$this->viewBuilder()->className('CsvView.Csv');
		return;        
    }
  
    /**
     * Exportar csv admitidos. AHORA MISMO NO ESTÁ EN FUNCIONAMIENTO
     */
    public function exportevaluados($id = null) {
		$this->response->download('export.csv');
        
		$this->loadModel('Usuarios');
        $data = $this->Usuarios
            ->find('all')
            ->join([
                'solicitudes' => [
                    'table' => 'solicitudes',
                    'type' => 'inner',
                    'conditions' => 'Usuarios.id = solicitudes.usuario_solicitante'],
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = solicitudes.convocatoria_id']                
                ])
             ->select(['Usuarios.id', 'Usuarios.Nombre', 'Usuarios.Apellidos', 'Usuarios.Dni', 'Usuarios.Direccion', 'Usuarios.Email', 'Usuarios.Telefono', 'Usuarios.Localidad', 'Usuarios.Cp'])
             ->where(['Usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND (convocatorias.id ='.$id.') AND (solicitudes.puntuacionEvaluacion IS NOT NULL)'])
             ->toArray();
        /*
         * NOTA: No puedes meterle el campo solicitudes.puntuacionEvaluacion porque al tratarse de otra tabla
         * el array que devuelve se convierte en multidimensional (array dentro de array) y peta
         */
        
		$_serialize = 'data';
        $_header = ['ID', 'Nombre', 'Apellidos', 'DNI', 'Direccion', 'Email', 'Telefono', 'Localidad', 'C.P.'];
        //$_extract = ['ID', 'Nombre', 'Apellidos', 'Dni', 'Direccion', 'Email', 'Telefono', 'Localidad', 'Cp'];
   		//$this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->set(compact('data', '_serialize', '_header'));
		$this->viewBuilder()->className('CsvView.Csv');
		return;       
    }
    
    public function duplicar($id = null) {

        if ($this->Convocatorias->duplicate($id)) {
            return $this->redirect(['action' => 'index','success_duplicate' => 1]);
        } else {
            return $this->redirect(['action' => 'index','fail_duplicate' => 1]);
        }        
    }
}