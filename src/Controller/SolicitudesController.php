<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Solicitudes Controller
 *
 * @property \App\Model\Table\SolicitudesTable $Solicitudes
 *
 * @method \App\Model\Entity\Solicitude[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudesController extends AppController
{

    public function index() {
        $this->paginate = [
            'contain' => ['Convocatorias', 'Usuarios']
        ];
		
        $solicitudes = $this->Solicitudes->find('all') 
        ->where(['Solicitudes.usuario_evaluador = '.$this->request->getSession()->read('Auth.User.id').' AND Solicitudes.fechaEvaluacion is NULL']);
					    
        $this->set('Solicitudes', $this->paginate($solicitudes));
        $this->set(compact('solicitudes'));
	}
	
    /**
     * View method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.     
     */
    public function view($id = null) {		
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Convocatorias', 'Usuarios']
        ]);
        
		$this->loadModel('SolicitudHasRequisitos');
		$solicitud_has_requisitos = $this->SolicitudHasRequisitos
			->find('all')  
			->join([
				'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'SolicitudHasRequisitos.id = evidencias.solicitud_has_requisitos_id'],
				'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'SolicitudHasRequisitos.requisito_id = requisitos.id']
				])
			->select(['evidencias.id','evidencias.descripcionEvidencia', 'evidencias.evidencia', 'evidencias.extension', 'requisitos.id', 'requisitos.descripcion', 'SolicitudHasRequisitos.valido', 'SolicitudHasRequisitos.id'])
			->where(['SolicitudHasRequisitos.solicitude_id ='.$id])
			->toArray();
        
        $this->loadModel('SolicitudHasMeritos');
		$solicitud_has_meritos = $this->SolicitudHasMeritos
			->find('all')  
			->join([
				'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'SolicitudHasMeritos.id = evidencias.solicitud_has_meritos_id'],
				'meritos' => [
					'table' => 'meritos',
					'type' => 'inner',
					'conditions' => 'SolicitudHasMeritos.merito_id = meritos.id'],
				'categorias' => [
					'table' => 'categorias',
					'type' => 'inner',
					'conditions' => 'meritos.categoria_id = categorias.id']
				])
			->select(['evidencias.id', 'evidencias.descripcionEvidencia', 'evidencias.evidencia', 'evidencias.extension', 'meritos.descripcion', 'meritos.tipos_meritos_id' ,'SolicitudHasMeritos.valido', 'categorias.PuntuacionMax', 'SolicitudHasMeritos.id'])
			->where(['SolicitudHasMeritos.solicitude_id ='.$id])
            ->order(['meritos.tipos_meritos_id' => 'ASC'])
			->toArray();

        //Solicitud_has_meritos para que cambien los meritos dinámicamente de merito.
        $this->loadModel('Meritos');
        $other_meritos = $this->Meritos
            ->find('list', ['valueField' => 'Descripcion'])
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'Meritos.convocatoria_id = convocatorias.id'],
                'solicitudes' => [
                    'table' => 'solicitudes',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = solicitudes.convocatoria_id']
            ])
            ->where(['solicitudes.id' => $id])
            ->toArray();
/*        
        $connection = ConnectionManager::get('default'); 
        $other_meritos = $connection
            ->newQuery()
            ->find('list', ['valueField' => 'meritos.Descripcion'])
            ->select('meritos.id, meritos.Descripcion')
            ->from('meritos, solicitudes, convocatorias')
            ->where(['solicitudes.id = '.$id.' AND solicitudes.convocatoria_id = convocatorias.id AND meritos.convocatoria_id = convocatorias.id ;'])
            ->execute()
            ->fetchAll('assoc');
*/        
		
		$this->set(compact('solicitud_has_requisitos','solicitud_has_meritos', 'other_meritos'));
		$this->set('solicitude', $solicitude);     
    }
	
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null) {
        $this->loadModel('Convocatorias');
        $convocatoria = $this->Convocatorias->get($id, [
            'contain' => ['Archivossubidos', 'Requisitos', 'Meritos', 'Solicitudes']
        ]); 
        $this->set('convocatoria', $convocatoria);
        
        $this->loadModel('Solicitudes');
        $solicitud = $this->Solicitudes->find('all', ['conditions' => ['convocatoria_id'=>$id, 'usuario_solicitante'=>$this->request->getSession()->read('Auth.User.id')]])->first();
        $this->set('solicitud', $solicitud);
        
        $solicitud_has_requisitos = $this->Convocatorias
            ->find()
            ->join([
                'solicitudes' => [
					'table' => 'solicitudes',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = solicitudes.convocatoria_id'],
                'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = requisitos.convocatoria_id'],
                'solicitud_has_requisitos' => [
					'table' => 'solicitud_has_requisitos',
					'type' => 'inner',
					'conditions' => 'requisitos.id = solicitud_has_requisitos.requisito_id']
            ])
			->select(['solicitud_has_requisitos.id'])
            //->distinct(['requisitos.id'])
			->where(['Convocatorias.id ='.$id.' AND solicitudes.id = solicitud_has_requisitos.solicitude_id AND solicitudes.usuario_solicitante ='.$this->request->getSession()->read('Auth.User.id')])
            ->toArray();
        $this->set('solicitud_has_requisitos', $solicitud_has_requisitos);
        
        //EVIDENCIAS DE REQUISITOS
        $evidencias= $this->Convocatorias
            ->find()
            ->join([
                'solicitudes' => [
					'table' => 'solicitudes',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = solicitudes.convocatoria_id'],
                'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = requisitos.convocatoria_id'],
                'solicitud_has_requisitos' => [
					'table' => 'solicitud_has_requisitos',
					'type' => 'inner',
					'conditions' => 'requisitos.id = solicitud_has_requisitos.requisito_id'],
                'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'evidencias.solicitud_has_requisitos_id = solicitud_has_requisitos.id']
            ])
			->select(['requisitos.id', 'evidencias.descripcionEvidencia', 'evidencias.id', 'evidencias.nombre_archivo', 'evidencias.extension'])
			->where(['Convocatorias.id ='.$id.' AND solicitudes.id = solicitud_has_requisitos.solicitude_id AND solicitudes.usuario_solicitante ='.$this->request->getSession()->read('Auth.User.id')])
            ->toArray();
        $this->set('evidencias', $evidencias);
        
        //EVIDENCIAS DE MERITOS
        $evidenciasM= $this->Convocatorias
            ->find()
            ->join([
                'solicitudes' => [
					'table' => 'solicitudes',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = solicitudes.convocatoria_id'],
                'meritos' => [
					'table' => 'meritos',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = meritos.convocatoria_id'],
                'solicitud_has_meritos' => [
					'table' => 'solicitud_has_meritos',
					'type' => 'inner',
					'conditions' => 'meritos.id = solicitud_has_meritos.merito_id'],
                'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'evidencias.solicitud_has_meritos_id = solicitud_has_meritos.id']
            ])
			->select(['meritos.id', 'evidencias.id', 'evidencias.nombre_archivo', 'evidencias.extension', 'evidencias.descripcionEvidencia', 'evidencias.solicitud_has_meritos_id'])
			->where(['Convocatorias.id ='.$id.' AND solicitudes.id = solicitud_has_meritos.solicitude_id AND solicitudes.usuario_solicitante ='.$this->request->getSession()->read('Auth.User.id')])
            ->toArray();
        $this->set('evidenciasM', $evidenciasM);
        
        //Variable que almacena las solicitudes_has_meritos que se van a mostrar en el div de méritos
        $solicitud_has_meritos = $this->Convocatorias
            ->find()
            ->join([
                'solicitudes' => [
					'table' => 'solicitudes',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = solicitudes.convocatoria_id'],
                'meritos' => [
					'table' => 'meritos',
					'type' => 'inner',
					'conditions' => 'Convocatorias.id = meritos.convocatoria_id'],
                'solicitud_has_meritos' => [
					'table' => 'solicitud_has_meritos',
					'type' => 'inner',
					'conditions' => 'meritos.id = solicitud_has_meritos.merito_id']
            ])
			->select(['solicitud_has_meritos.id', 'meritos.descripcion', 'meritos.tipos_meritos_id'])
            //->distinct(['requisitos.id'])
			->where(['Convocatorias.id ='.$id.' AND solicitudes.id = solicitud_has_meritos.solicitude_id AND solicitudes.usuario_solicitante ='.$this->request->getSession()->read('Auth.User.id')])
            ->toArray();
        $this->set('solicitud_has_meritos', $solicitud_has_meritos);


        $this->loadModel('Usuarios');
        $user_id = $this->request->getSession()->read('Auth.User.id');
        $usuario = $this->Usuarios->get($user_id);
        $this->set('usuario', $usuario);
        

        /* ------------------------------------- */        
        
        $solicitude = $this->Solicitudes->newEntity();
        
        if ($this->request->is('post')) {
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('The solicitude has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitude could not be saved. Please, try again.'));
        }
        $convocatorias = $this->Solicitudes->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'convocatorias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
		$this->paginate = [
            'contain' => ['Convocatorias', 'Usuarios']
        ];
		
		$where = "";
			
		// FILTROS de busqueda:
		if($this->request->getSession()->read('Auth.User.Perfile_id') == 1)
		{
			if(isset($_GET['estado']))
			{
				if($_GET['estado'] == 'Asignadas')
				{
					$where = '(Solicitudes.usuario_evaluador IS NOT NULL)';

				}else if ($_GET['estado'] == 'No_Asignadas') 
				{
					$where = '(Solicitudes.usuario_evaluador IS NULL)';

				}else if ($_GET['estado'] == 'Todos')
				{
					$where = '(Solicitudes.usuario_evaluador IS NOT NULL OR Solicitudes.usuario_evaluador IS NULL)';
				}	
			}
		
		    if (isset($_GET['termino'])) {
				$where .= ' AND (Convocatorias.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Nombre LIKE "%'.$_GET['termino'].'%")'; // SI LO PONES AQUI SUPERADMINS NO VAN
        	}
		}	
		
		if ($this->request->getSession()->read('Auth.User.Perfile_id') != 1) 
		{
			// Si tiene permisos para listar el index ('23') lista las solicitudes pertenecientes a la empresa
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
				->where(['perfil_acciones.Perfile_id='.$this->request->getSession()->read('Auth.User.Perfile_id').' AND acciones.controlador="solicitudes" AND acciones.metodo="index"'])
				->toArray();
			
			if ($query['0']['perfil_acciones']['accione_id'] == 23) {
				$where .= "(Usuarios.Perfile_id IN (2,3,4,5) AND Usuarios.Empresa_id=".$this->request->getSession()->read('Auth.User.Empresa_id').")"; 
				
				if($this->request->getSession()->read('Auth.User.Perfile_id') != 1){

					if(isset($_GET['estado']))
					{
						if($_GET['estado'] == 'Asignadas')
						{
							$where .= 'AND (Solicitudes.usuario_evaluador IS NOT NULL)';

						}else if ($_GET['estado'] == 'No_Asignadas') 
						{
							$where .= 'AND (Solicitudes.usuario_evaluador IS NULL)';

						}else if ($_GET['estado'] == 'Todos')
						{
							$where .= 'AND (Solicitudes.usuario_evaluador IS NOT NULL OR Solicitudes.usuario_evaluador IS NULL)';
						}	
					}

					if (isset($_GET['termino'])) {
						$where .= ' AND (Convocatorias.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Nombre LIKE "%'.$_GET['termino'].'%")'; // SI LO PONES AQUI SUPERADMINS NO VAN
					}
				}
				
			}
			
			// Sacamos el select de usuarios de la misma empresa y que tienen la accion de poder evaluar
			$this->loadModel('Usuarios');
			$usuarios = $this->Usuarios->find('list', ['valueField' => 'Nombre'])
						->join([
							'Perfiles' => [
								'table' => 'perfiles',
								'type' => 'inner',
								'conditions' => 'Perfiles.id = Usuarios.Perfile_id'],
							'perfil_acciones' => [
								'table' => 'perfil_acciones',
								'type' => 'inner',
								'conditions' => 'perfil_acciones.Perfile_id = Perfiles.id']
						])
						->where(['(Usuarios.Perfile_id IN (2,3,4) AND Usuarios.Empresa_id='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND perfil_acciones.accione_id = "28")'])
						->select(['id' ,'Nombre'])
						->order(['Usuarios.id']);
		}else {
			$this->loadModel('Usuarios');
			$usuarios = $this->Usuarios->find('list', ['valueField' => 'Nombre'])
						->select(['id' ,'Nombre'])
						->order(['Usuarios.id']);
		}	
		
        $solicitudes = $this->Solicitudes->find('all') 
        ->where($where);
		
        $this->set('Solicitudes', $this->paginate($solicitudes));
        $this->set(compact('solicitudes','usuarios'));
		
		//-------------------------------------------------
		
        /*  EDIT SOLICITUD:
		$solicitude = $this->Solicitudes->get($id, [
            'contain' => [] 
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
            $solicitude = $this->Solicitudes->patchEntity($solicitude, $this->request->getData());
            if ($this->Solicitudes->save($solicitude)) {
                $this->Flash->success(__('The solicitude has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitude could not be saved. Please, try again.'));
        }
        $convocatorias = $this->Solicitudes->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('solicitude', 'convocatorias'));
		*/
    }

/*--------------------------------AJAX EVALUACION SOLICITUDES EMPRESA--------------------------------*/      

	public function cambiarusuarioevaluador() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $solicitud_id = $_POST['solicitud_id'];
            $usuario_evaluador = $_POST['usuario_evaluador'];
			
            $solicitude = TableRegistry::get("Solicitudes");
            $query = $solicitude->query();

            $result = $query->update()
            ->set(['usuario_evaluador' => $usuario_evaluador])
            ->where(['id' => $solicitud_id])
            ->execute();
            
            echo json_encode(array('result' => true));   
        }
    }
    
	public function cambiarmeritoid() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $merito_selected = $_POST['selected'];
            $merito_id = $_POST['id'];
			
            $solicitudhasmerito = TableRegistry::get("SolicitudHasMeritos");
            $query = $solicitudhasmerito->query();

            $result = $query->update()
            ->set(['merito_id' => $merito_selected])
            ->where(['id' => $merito_id])
            ->execute();
           /* 
            $meritos = TableRegistry::get('Meritos');
            $merito = $meritos
                ->find()
                ->where(['meritos.id = '.$_GET['num'].';'])
                ->first();

            $descripcion = debug($merito->Descripcion);
            */
            $result = true;
            //echo json_encode(array('result' => $result, 'descripcion' => $descripcion));            
            echo json_encode(array('result' => $result));            
        }    
    }    
	
	public function evaluarequisitosolicitud() {
		
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $idsolicitudhasrequisito = $_POST['solicitudhasrequisito_id'];
            $valido = $_POST['valido'];
			
            $solicitudhasrequisito = TableRegistry::get("SolicitudHasRequisitos");
            $query = $solicitudhasrequisito->query();

            $result = $query->update()
            ->set(['valido' => $valido])
            ->where(['id' => $idsolicitudhasrequisito])
            ->execute();

        }
    }
	
	public function evaluarmeritosolicitud() {
		
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $idsolicitudhasmerito = $_POST['solicitudhasmerito_id'];
            $valido = $_POST['valido'];
			$solicitud_id =$_POST['solicitud_id'];
			
            $solicitudhasmerito = TableRegistry::get("SolicitudHasMeritos");			
            $query = $solicitudhasmerito->query();

            $result = $query->update()
            ->set(['valido' => $valido])
            ->where(['id' => $idsolicitudhasmerito])
            ->execute();
			
        }
		
		$this->loadModel('SolicitudHasMeritos');
			$solicitud_has_meritos = $this->SolicitudHasMeritos
				->find('all')  
				->join([
					'meritos' => [
						'table' => 'meritos',
						'type' => 'inner',
						'conditions' => 'SolicitudHasMeritos.merito_id = meritos.id'],
					'categorias' => [
						'table' => 'categorias',
						'type' => 'inner',
						'conditions' => 'meritos.categoria_id = categorias.id']
					])
				->select(['SolicitudHasMeritos.valido', 'SolicitudHasMeritos.id', 'meritos.id', 'categorias.id', 'categorias.PuntuacionMax', 'meritos.Puntuacion'])
				->where(['SolicitudHasMeritos.valido = 1 AND SolicitudHasMeritos.solicitude_id ='.$solicitud_id])
				->toArray();
		
			
			/*
			* PORTILLO
			*
			* Algoritmo que suma la puntuacion de meritos por categorias sin que dicha suma
			* rebase la puntuación máxima de la categoría.
			*
			*/
			$resultArray = array();

			foreach ($solicitud_has_meritos as $item) {
				if (!isset($resultArray[$item['categorias']['id']])) $resultArray[$item['categorias']['id']] = array('Puntuacion' => 0, 'PuntuacionMax' => $item['categorias']['PuntuacionMax']);
				
				$resultArray[$item['categorias']['id']]['Puntuacion'] += $item['meritos']['Puntuacion'];

			}

			$suma = 0;
			foreach ($resultArray as $row) {
				if ($row['Puntuacion'] > $row['PuntuacionMax']) $row['Puntuacion'] = $row['PuntuacionMax'];
				$suma += $row['Puntuacion'];
			}
			
			/*La variable "result"  debe ser true o false dependiendo si los algoritmos se ejecutan o fallan.
			  Se devuelve con el json (ajax) para saber si todo ha ido bien. Como no sé como comprobar que aquí ha ido
			  todo bien le asigno manualmente la variable "true" */ 
			$result = true;
		
			echo json_encode(array('result' => $result, 'suma' => $suma));
			  
    }
	
	public function novaliduser() {
		
        $this->autoRender = false;
        if ($this->request->is('post')) {
			
			if(isset($_POST['puntuación_evaluacion']))
			{
				$puntuación_evaluacion = $_POST['puntuación_evaluacion'];
			}else
			{
				$puntuación_evaluacion = null;
			}
			
            $idsolicitud = $_POST['solicitud_id'];
			$aceptado = $_POST['valido'];
			$fecha = date("Y-m-d");
            
            if((isset($_POST['reclamacion'])) && ($_POST['reclamacion']== 1)){
                
                $reclamacion = 1;
                $solicitud = TableRegistry::get("Solicitudes");
                $query = $solicitud->query();

                $result = $query->update()
                ->set(['aceptado' => $aceptado, 'fechaEvaluacion' => $fecha, 'puntuacionEvaluacion' => $puntuación_evaluacion, 'reclamacion' => $reclamacion])
                ->where(['id' => $idsolicitud])
                ->execute();
                
            }else if((isset($_POST['reclamacionEvaluacion'])) && ($_POST['reclamacionEvaluacion']== 1)){
                
                $reclamacion = 1;
                $solicitud = TableRegistry::get("Solicitudes");
                $query = $solicitud->query();

                $result = $query->update()
                ->set(['aceptado' => $aceptado, 'fechaEvaluacion' => $fecha, 'puntuacionEvaluacion' => $puntuación_evaluacion, 'reclamacionEvaluacion' => $reclamacion])
                ->where(['id' => $idsolicitud])
                ->execute();
                
            }else {
                $solicitud = TableRegistry::get("Solicitudes");
                $query = $solicitud->query();

                $result = $query->update()
                ->set(['aceptado' => $aceptado, 'fechaEvaluacion' => $fecha, 'puntuacionEvaluacion' => $puntuación_evaluacion])
                ->where(['id' => $idsolicitud])
                ->execute();
            }
			
        }
		$result = true;
		
		echo json_encode(array('result' => $result));

    }
    
    public function validoevaluacionrequisitos() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['solicitud_id']; 

            $solicitudesTable = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudesTable->get($id_solicitud);
            
            if($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }

//insertamos en log
    public function requisitoslog(){
        $this->autoRender = false; 
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 
            $id_usuario = $this->request->getSession()->read('Auth.User.id');

            $logTable = TableRegistry::get("Log");
            $log = $logTable->newEntity();
            
            $log->solicitudes_id = $id_solicitud;
            $log->usuarios_id = $id_usuario;
            $log->descripcion = "Evalua Requisitos";
            $log->fecha = date("Y-m-d H:i:s");
            
            if($logTable->save($log)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));         
    }
    
    public function meritoslog(){
        $this->autoRender = false; 
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 
            $id_usuario = $this->request->getSession()->read('Auth.User.id');

            $logTable = TableRegistry::get("Log");
            $log = $logTable->newEntity();
            
            $log->solicitudes_id = $id_solicitud;
            $log->usuarios_id = $id_usuario;
            $log->descripcion = "Evalua Meritos";
            $log->fecha = date("Y-m-d H:i:s");
            
            if($logTable->save($log)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));         
    }
    
    public function asignarlog(){
        $this->autoRender = false; 
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 
            $id_usuario = $this->request->getSession()->read('Auth.User.id');

            $logTable = TableRegistry::get("Log");
            $log = $logTable->newEntity();
            
            $log->solicitudes_id = $id_solicitud;
            $log->usuarios_id = $id_usuario;
            $log->descripcion = "Asigna Evaluador";
            $log->fecha = date("Y-m-d H:i:s");
            
            if($logTable->save($log)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));         
    } 
    
//habilitamos de nuevo la reclamacion   
    public function habilitarreclamacion(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id = $_POST['id'];  
            
            $solicitudes = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudes->get($id);
            
            $solicitud->reclamacion = null;
            $solicitud->reclamacionEvaluacion = null;
            $solicitud->fechaReclamacion = null;
            $solicitud->fechaReclamacionEvaluacion = null;
            
            if($solicitudes->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }

/*--------------------------------------- FIN AJAX SOLICITUDES---------------------------------------*/       
	
    /**
     * Delete method
     *
     * @param string|null $id Solicitude id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $solicitude = $this->Solicitudes->get($id);
        if ($this->Solicitudes->delete($solicitude)) {
            $this->Flash->success(__('The solicitude has been deleted.'));
        } else {
            $this->Flash->error(__('The solicitude could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function listar($id = null) {
        
        if (isset($id)) {
            $this->set('id', $id);
        }
        
        $this->paginate = [
            'contain' => ['Convocatorias', 'Usuarios']
        ];

        $where = "";

		/* -------------------------------------- FILTROS: --------------------------------------*/
        if(isset($_GET['convocatorias']) && $_GET['convocatorias'] !="") {
            $where .= " AND (Convocatorias.id = ".$_GET['convocatorias'].")";
        }else if (isset($_GET['convocatorias']) && $_GET['convocatorias'] == "") {
            $where .= "";
        }else if (isset($id)) {
            $where .= " AND (Convocatorias.id = ".$id.")";
        }
        
        if(isset($_GET['termino']) && ($_GET['termino'] != "")) {
            $where .= ' AND (Usuarios.Nombre LIKE "%'.$_GET['termino'].'%" OR Usuarios.Apellidos LIKE "%'.$_GET['termino'].'%" OR Usuarios.Dni LIKE "%'.$_GET['termino'].'%" OR Usuarios.Email LIKE "%'.$_GET['termino'].'%")';
        }
        
        if(isset($_GET['estado']) && ($_GET['estado'] != "")) {  
            
            switch($_GET['estado']){
                case "Aceptadas":
                    $where .= ' AND (Solicitudes.aceptado = 1)';
                    break;
                case "No_evaluadas":
                    $where .= ' AND (Solicitudes.usuario_evaluador IS NOT NULL AND Solicitudes.aceptado IS NULL)';
                    break;                    
                case "No_Asignadas":
                    $where .= ' AND (Solicitudes.usuario_evaluador IS NULL)';
                    break;
                case "No_cumple_requisitos":
                    $where .= ' AND (Solicitudes.aceptado = 0)';
                    break;
                case "Reclamadas":
                    $where .= ' AND (Solicitudes.fechaReclamacion IS NOT NULL OR Solicitudes.fechaReclamacionEvaluacion IS NOT NULL)';
                    break;
                case "Reclamaciones_No_Asignadas":
                    $where .= '';
                    break;
                default:
                    $where .= '';
            }
        }
        /* ------------------------------------FIN FILTROS: --------------------------------------*/
        
        $solicitudes = $this->Solicitudes
            ->find('all')
            ->join([
                'Convocatorias' => [
                    'table' => 'Convocatorias',
                    'type' => 'inner',
                    'conditions' => 'Convocatorias.id = Solicitudes.convocatoria_id'],
                'Usuarios' => [
                    'table' => 'Usuarios',
                    'type' => 'inner',
                    'conditions' => 'Usuarios.id = Solicitudes.usuario_solicitante']
                ])
             ->select(['Solicitudes.id', 'Convocatorias.Nombre', 'Usuarios.Nombre', 'Usuarios.Apellidos', 'Solicitudes.usuario_evaluador', 'Solicitudes.fechaReclamacion', 'Solicitudes.aceptado'])
             ->where(['Usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id').$where]);
        $this->set('solicitudes', $this->paginate($solicitudes));
        
        $this->loadModel('Convocatorias');
		$convocatorias = $this->Convocatorias
            ->find('list', ['valueField' => 'Nombre'])
            ->join([
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'Convocatorias.Usuario_id = usuarios.id']
                ])            
            ->select(['id' ,'Nombre'])
            ->where(['usuarios.Empresa_id ='.$this->request->getSession()->read('Auth.User.Empresa_id')]);
        $this->set('convocatorias', $convocatorias);        
        
	}
    
    public function ver ($id = null) {
        
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Convocatorias', 'Usuarios']
        ]);
        $this->set('solicitude', $solicitude);
        
        $perfil = $this->request->getSession()->read('Auth.User.Perfile_id');
        $this->set('perfil', $perfil);           
        
        $estado = "";
        if($solicitude['usuario_evaluador'] == null) {
             $estado = "No asignada";
         } else if (($solicitude['fechaReclamacion'] != null) || ($solicitude['fechaReclamacionEvaluacion'] != null)) {
             $estado = "Reclamada";
            
            if(($solicitude['fechaReclamacion'] != null) && ($solicitude['reclamacion'] == 1) && ($solicitude['aceptado'] == 1)){
                $estado = "Reclamada y aceptada";
            }else if (($solicitude['fechaReclamacion'] != null) && ($solicitude['reclamacion'] == 1) && ($solicitude['aceptado'] == 0)){
                $estado = "Reclamada y No aceptada";
            }
            if(($solicitude['fechaReclamacionEvaluacion'] != null) && ($solicitude['reclamacionEvaluacion'] == 1)) {
                $estado = "Reclamada y Evaluada";
            }
            
         } else if ($solicitude['aceptado'] == 1) {
             $estado = "Aceptada";
         } else if ($solicitude['aceptado'] !== null) { 
             $estado = "No cumple requisitos";
         } else if (($solicitude['usuario_evaluador']) != null && ($solicitude['aceptado']) === null){
             $estado = "Asignadas No evaluadas";
         }
        $this->set('estado', $estado);
        
        $this->loadModel('Usuarios');
		$usuarios = $this->Usuarios->find('list', ['valueField' => 'Nombre'])
				->join([
					'Perfiles' => [
						'table' => 'perfiles',
						'type' => 'inner',
						'conditions' => 'Perfiles.id = Usuarios.Perfile_id'],
					'perfil_acciones' => [
						'table' => 'perfil_acciones',
						'type' => 'inner',
						'conditions' => 'perfil_acciones.Perfile_id = Perfiles.id']
				])
				->where(['(Usuarios.Perfile_id IN (2,3,4) AND Usuarios.Empresa_id='.$this->request->getSession()->read('Auth.User.Empresa_id').' AND perfil_acciones.accione_id = "28")'])
				->select(['id' ,'Nombre'])
				->order(['Usuarios.id']);
        $this->set('usuarios', $usuarios);
        
		$this->loadModel('SolicitudHasRequisitos');
		$solicitud_has_requisitos = $this->SolicitudHasRequisitos
			->find('all')  
			->join([
				'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'SolicitudHasRequisitos.requisito_id = requisitos.id']
				])
			->select(['requisitos.id', 'requisitos.descripcion', 'requisitos.motivo_exclusion', 'SolicitudHasRequisitos.valido', 'SolicitudHasRequisitos.id'])
			->where(['(SolicitudHasRequisitos.solicitude_id ='.$id.') AND (SolicitudHasRequisitos.valido = 0);'])
			->toArray();
		$this->set(compact('solicitud_has_requisitos'));        
        
        $this->loadModel('Log');
        $logs = $this->Log
            ->find('all')
            ->join([
                'usuarios' => [
                    'table' => 'usuarios',
                    'type' => 'inner',
                    'conditions' => 'Log.usuarios_id = usuarios.id'],
                'solicitudes' => [
                    'table' => 'solicitudes',
                    'type' => 'inner',
                    'conditions' => 'Log.solicitudes_id = solicitudes.id']
                ])
            ->select(['usuarios.Nombre','usuarios.Apellidos','Log.fecha','Log.descripcion'])
            ->where(['Log.solicitudes_id ='.$id])
            ->toArray();
        $this->set('logs', $logs);
    }
    
    public function requisitos ($id = null) {	 	
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Convocatorias', 'Usuarios', 'Reclamaciones']
        ]);
        
        $perfil = $this->request->getSession()->read('Auth.User.Perfile_id');
        $this->set('perfil', $perfil);
        
		$this->loadModel('SolicitudHasRequisitos');
		$solicitud_has_requisitos = $this->SolicitudHasRequisitos
			->find('all')  
			->join([
				'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'SolicitudHasRequisitos.id = evidencias.solicitud_has_requisitos_id'],
				'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'SolicitudHasRequisitos.requisito_id = requisitos.id']
				])
			->select(['evidencias.id','evidencias.descripcionEvidencia', 'evidencias.evidencia', 'evidencias.reclamacion_id', 'evidencias.extension', 'requisitos.id', 'requisitos.descripcion', 'SolicitudHasRequisitos.valido', 'SolicitudHasRequisitos.id'])
			->where(['SolicitudHasRequisitos.solicitude_id ='.$id])
			->toArray();
		
		$this->set(compact('solicitud_has_requisitos'));
		$this->set('solicitude', $solicitude);     
    }
    
    public function meritos($id = null) {		
        $solicitude = $this->Solicitudes->get($id, [
            'contain' => ['Convocatorias', 'Usuarios', 'Reclamaciones']
        ]);
    
        $perfil = $this->request->getSession()->read('Auth.User.Perfile_id');
        $this->set('perfil', $perfil);    
        
        $this->loadModel('SolicitudHasMeritos');
		$solicitud_has_meritos = $this->SolicitudHasMeritos
			->find('all')  
			->join([
				'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'SolicitudHasMeritos.id = evidencias.solicitud_has_meritos_id'],
				'meritos' => [
					'table' => 'meritos',
					'type' => 'inner',
					'conditions' => 'SolicitudHasMeritos.merito_id = meritos.id'],
				'categorias' => [
					'table' => 'categorias',
					'type' => 'inner',
					'conditions' => 'meritos.categoria_id = categorias.id']
				])
			->select(['evidencias.id', 'evidencias.descripcionEvidencia', 'evidencias.evidencia', 'evidencias.reclamacion_id', 'evidencias.extension', 'meritos.descripcion', 'meritos.tipos_meritos_id' ,'SolicitudHasMeritos.valido', 'categorias.PuntuacionMax', 'SolicitudHasMeritos.id'])
			->where(['SolicitudHasMeritos.solicitude_id ='.$id])
            ->order(['meritos.tipos_meritos_id' => 'ASC'])
			->toArray();

        //Solicitud_has_meritos para que cambien los meritos dinámicamente de merito.
        $this->loadModel('Meritos');
        $other_meritos = $this->Meritos
            ->find('list', ['valueField' => 'Descripcion'])
            ->join([
                'convocatorias' => [
                    'table' => 'convocatorias',
                    'type' => 'inner',
                    'conditions' => 'Meritos.convocatoria_id = convocatorias.id'],
                'solicitudes' => [
                    'table' => 'solicitudes',
                    'type' => 'inner',
                    'conditions' => 'convocatorias.id = solicitudes.convocatoria_id']
            ])
            ->where(['solicitudes.id' => $id])
            ->toArray();    
		
		$this->set(compact('solicitud_has_meritos', 'other_meritos'));
		$this->set('solicitude', $solicitude);     
    }
    
    //Esta función verifica si hay creada ya una reclamación para la solicitud y si no la crea
    public function createreclamacionadmision($id_solicitud){
        
        $reclamaciones = TableRegistry::get('Reclamaciones'); 
        $reclamacion = $reclamaciones 
                ->find()
                ->where(['solicitude_id = '.$id_solicitud.' AND tipo = "admision";'])
                ->first();
            
        if(($reclamacion == "") || ($reclamacion == null)){
            $reclamacion = $reclamaciones->newEntity();
            $reclamacion->tipo = "admision";
            $reclamacion->solicitude_id = $id_solicitud;

            if($reclamaciones->save($reclamacion)){
                $reclamacion_id = $reclamacion->id;
            }
        }else {
            $reclamacion_id = $reclamacion->id; 
        }  
        return $reclamacion_id;
    }
    
    public function reclamaradmision($id = null) {
                
        $this->loadModel('Solicitudes');
        $solicitud = $this->Solicitudes->get($id, [
            'contain' => ['SolicitudHasRequisitos', 'Reclamaciones']
        ]); 
        $this->set('solicitud', $solicitud);
        
        //Comprobamos si está creada la reclamación y si no la creamos
        if($id != null || $id != ""){
            $id_reclamacion = $this->createreclamacionadmision($id);
        }else {
            $this->Flash->error(__('No se ha encontrado la solicitud para vincular la reclamacion. Por favor, contacte con el  administrador' ));
        }
        if(isset($id_reclamacion)) { $this->set('id_reclamacion', $id_reclamacion);}        
        
        $solicitud_has_requisitos = $this->Solicitudes
            ->find()
            ->join([
                'convocatorias' => [
					'table' => 'convocatorias',
					'type' => 'inner',
					'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'requisitos' => [
					'table' => 'requisitos',
					'type' => 'inner',
					'conditions' => 'requisitos.convocatoria_id = convocatorias.id'],
                'solicitud_has_requisitos' => [
					'table' => 'solicitud_has_requisitos',
					'type' => 'inner',
					'conditions' => 'requisitos.id = solicitud_has_requisitos.requisito_id']
            ])
			->select(['requisitos.id', 'requisitos.Descripcion'])
            ->distinct(['requisitos.id'])
            ->where(['Solicitudes.id ='.$id])
            ->toArray();
        $this->set('solicitud_has_requisitos', $solicitud_has_requisitos);        
        
        //EVIDENCIAS DE REQUISITOS
        $evidencias= $this->Solicitudes
            ->find()
            ->join([
                'solicitud_has_requisitos' => [
					'table' => 'solicitud_has_requisitos',
					'type' => 'inner',
					'conditions' => 'Solicitudes.id = solicitud_has_requisitos.solicitude_id'],
                'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'evidencias.solicitud_has_requisitos_id = solicitud_has_requisitos.id']
            ])
			->select(['solicitud_has_requisitos.requisito_id', 'evidencias.descripcionEvidencia', 'evidencias.extension', 'evidencias.evidencia', 'evidencias.id', 'evidencias.nombre_archivo', 'evidencias.reclamacion_id'])
			->where(['Solicitudes.id ='.$id])
            ->toArray();
        $this->set('evidencias', $evidencias);        
    }

    //Esta función verifica si hay creada ya una reclamación para la solicitud y si no la crea
    public function createreclamacionevaluacion($id_solicitud){
        
        $reclamaciones = TableRegistry::get('Reclamaciones'); 
        $reclamacion = $reclamaciones 
                ->find()
                ->where(['solicitude_id = '.$id_solicitud.' AND tipo = "evaluacion";'])
                ->first();
            
        if(($reclamacion == "") || ($reclamacion == null)){
            $reclamacion = $reclamaciones->newEntity();
            $reclamacion->tipo = "evaluacion";
            $reclamacion->solicitude_id = $id_solicitud;

            if($reclamaciones->save($reclamacion)){
                $reclamacion_id = $reclamacion->id;
            }
        }else {
            $reclamacion_id = $reclamacion->id; 
        }  
        return $reclamacion_id;
    }    
    
    public function reclamarevaluacion($id = null) {
                
        $this->loadModel('Solicitudes');
        $solicitud = $this->Solicitudes->get($id, [
            'contain' => ['SolicitudHasMeritos', 'Reclamaciones']
        ]); 
        $this->set('solicitud', $solicitud);
        
        //Comprobamos si está creada la reclamación y si no la creamos
        if($id != null || $id != ""){
            $id_reclamacion = $this->createreclamacionevaluacion($id);
        }else {
            $this->Flash->error(__('No se ha encontrado la solicitud para vincular la reclamacion. Por favor, contacte con el  administrador' ));
        }
        if(isset($id_reclamacion)) { $this->set('id_reclamacion', $id_reclamacion);}        

        //Variable que almacena las solicitudes_has_meritos que se van a mostrar en el div de méritos
        $solicitud_has_meritos = $this->Solicitudes
            ->find()
            ->join([
                'convocatorias' => [
					'table' => 'convocatorias',
					'type' => 'inner',
					'conditions' => 'convocatorias.id = Solicitudes.convocatoria_id'],
                'meritos' => [
					'table' => 'meritos',
					'type' => 'inner',
					'conditions' => 'convocatorias.id = meritos.convocatoria_id'],
                'solicitud_has_meritos' => [
					'table' => 'solicitud_has_meritos',
					'type' => 'inner',
					'conditions' => 'meritos.id = solicitud_has_meritos.merito_id']
            ])
			->select(['solicitud_has_meritos.id','meritos.id', 'meritos.descripcion', 'meritos.tipos_meritos_id'])
            ->distinct(['meritos.id'])
            ->where(['Solicitudes.id ='.$id])
            ->toArray();
        $this->set('solicitud_has_meritos', $solicitud_has_meritos);
        
        //EVIDENCIAS DE REQUISITOS
        $evidencias= $this->Solicitudes
            ->find()
            ->join([
                'solicitud_has_meritos' => [
					'table' => 'solicitud_has_meritos',
					'type' => 'inner',
					'conditions' => 'Solicitudes.id = solicitud_has_meritos.solicitude_id'],
                'evidencias' => [
					'table' => 'evidencias',
					'type' => 'inner',
					'conditions' => 'evidencias.solicitud_has_meritos_id = solicitud_has_meritos.id']
            ])
			->select(['solicitud_has_meritos.merito_id', 'evidencias.id', 'evidencias.descripcionEvidencia', 'evidencias.extension', 'evidencias.evidencia', 'evidencias.id', 'evidencias.nombre_archivo', 'evidencias.reclamacion_id', 'evidencias.solicitud_has_meritos_id'])
			->where(['Solicitudes.id ='.$id])
            ->toArray();
        $this->set('evidencias', $evidencias); 
        
    }     
/*-----------------------------------------SOLICITANTE-----------------------------------------*/    

    /**
     * EditUser method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function edituser() {
        $id = $this->request->getSession()->read('Auth.User.id');
        
        $usuarios = TableRegistry::get('Usuarios');
        $usuario = $usuarios->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
                    
            $usuario->Direccion = $this->request->data['Direccion'];
            // $user->email= abc@gmail.com; // other fields if necessary   $this->request->data['Email'];
            $usuario->Localidad = $this->request->data['Localidad'];
            $usuario->Cp = $this->request->data['Cp'];
            $usuario->Telefono = $this->request->data['Telefono'];            

            // image [error] 4 significa que NO se ha subido ningun fichero. (Si no peta)
            if($this->request->data['Foto']['error'] != 4)	{
                $imgData = base64_encode(file_get_contents($this->request->data['Foto']['tmp_name']));             
                $usuario['Foto'] = $imgData;
            }
            
            if($usuarios->save($usuario)){
                $this->Flash->success(__('Datos editados correctamente.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('Los datos no se pudieron editar. Por favor, intentelo de nuevo.'));
                return $this->redirect($this->referer());
            } 
        }
    }
    
/*--------------------------------AJAX SOLICITUDES SOLICITANTES--------------------------------*/ 
    
    // Crea la solicitud
    public function createsolicitud() {
        $this->autoRender = false;
             
        if ($this->request->is('post')) {
            $convocatoria_id = $_POST['convocatoria_id'];
           	
            $solicitudesTable = TableRegistry::get('Solicitudes');
            $solicitud = $solicitudesTable->newEntity();
            
            $solicitud->convocatoria_id = $convocatoria_id;
            $solicitud->usuario_solicitante = $this->request->getSession()->read('Auth.User.id');
            $solicitud->fechaCreacion = date("Y-m-d");
            $solicitud->leido_declaracion_responsable = 1;
            
            if ($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
            echo json_encode(array('result' => $result));  
        }  
    }
    
    /*
     * CREA solicitud_has_requisito Y evidencia:
     *  1º-> Comprueba si existe registro en la tabla "solicitud_has_requisito". Si no existe lo crea.
     *  2º-> Añade el archivo a la tabla "evidencias" con el id de solicitud_has_requisito que se ha creado
     *       o se ha chekeado que existe.
     */
    public function saverequisitoevidencia() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $requisito_id = $_POST['requisito_id']; //$this->request->getData('requisito_id');
            $solicitud_id = $_POST['solicitud_id']; //$this->request->getData('solicitud_id');
            $descripcion = $_POST['Descripcion']; 
            //$archivo = $_POST['RequisitoArchivo'];

            $solicitud_has_requisitos = TableRegistry::get("SolicitudHasRequisitos");
            $solicitud_has_requisito = $solicitud_has_requisitos
                ->find()
                ->where(['solicitude_id = '.$solicitud_id.' AND requisito_id = '.$requisito_id])
                ->first();
            
            if(is_null($solicitud_has_requisito)) {
                $solicitud_has_requisito = $solicitud_has_requisitos->newEntity();
                
                $solicitud_has_requisito->solicitude_id = $solicitud_id;
                $solicitud_has_requisito->requisito_id = $requisito_id;
                
                if($solicitud_has_requisitos->save($solicitud_has_requisito)) {
                    $mensaje = "Se ha creado la solicitud_has_requisito con id = ".$solicitud_has_requisito->id;
                    
                    //Creamos la evidencia
                    $evidencias = TableRegistry::get("Evidencias");
                    $evidencia = $evidencias->newEntity();
                    
                    if($this->request->data['RequisitoArchivo']['error'] != 0)	{
                        $mensaje .= ". No se ha podido crear el archivo por error en la subida = ".$this->request->data['RequisitoArchivo']['error'];
                        $result = false;
                        
                    }else
                    {
 
                        $info = pathinfo($this->request->data['RequisitoArchivo']['name']);
                        $extension = strtolower($info['extension']);
                        $name = $info['filename'];
                        $size = ($this->request->data['RequisitoArchivo']['size']);                        
                        $imgData = base64_encode(file_get_contents($this->request->data['RequisitoArchivo']['tmp_name']));
                        
                        $evidencia->evidencia = $imgData;
                        $evidencia->descripcionEvidencia = $this->request->data['Descripcion']; 
                        $evidencia->nombre_archivo = $name;
                        $evidencia->extension = $extension;
                        $evidencia->tamanho = $size;
                        $evidencia->solicitud_has_requisitos_id = $solicitud_has_requisito->id;
                        if(isset($this->request->data['reclamacion_id']) && ($this->request->data['reclamacion_id'] != "")){
                            $evidencia->reclamacion_id = $this->request->data['reclamacion_id'];
                        }
                         
                    }

                    if($evidencias->save($evidencia)) {
                        //$this->Flash->success(__('The evidencia has been saved.'));
                        //return $this->redirect(['action' => 'index']);
                        $mensaje .= ". La evidencia se ha guardado correctamente.";
                        $result = true;
                        
                    }else{
                        $mensaje .= ". La evidencia no ha podido guardarse.";
                        $result = false;
                    }   
         
                }else {
                    $result = false;
                    $mensaje = "No se ha podido crear la solicitud_has_requisito";
                }
                
            }else {
                $result = true;
                $mensaje = "solicitud_has_requisito ya existente, con id = ".$solicitud_has_requisito->id;
                
                //Creamos la evidencia
                $evidencias = TableRegistry::get("Evidencias");
                $evidencia = $evidencias->newEntity();

                if($this->request->data['RequisitoArchivo']['error'] != 0)	{
                    $mensaje .= ". No se ha podido crear el archivo por error en la subida = ".$this->request->data['RequisitoArchivo']['error'];
                    $result = false;

                }else
                {

                    $info = pathinfo($this->request->data['RequisitoArchivo']['name']);
                    $extension = strtolower($info['extension']);
                    $name = $info['filename'];
                    $size = ($this->request->data['RequisitoArchivo']['size']);                        
                    $imgData = base64_encode(file_get_contents($this->request->data['RequisitoArchivo']['tmp_name']));

                    $evidencia->evidencia = $imgData;
                    $evidencia->descripcionEvidencia = $descripcion;
                    $evidencia->nombre_archivo = $name;
                    $evidencia->extension = $extension;
                    $evidencia->tamanho = $size;
                    $evidencia->solicitud_has_requisitos_id = $solicitud_has_requisito->id;
                    if(isset($_POST['reclamacion_id']) && ($_POST['reclamacion_id'] != "")){
                         $evidencia->reclamacion_id = $_POST['reclamacion_id'];
                    }                    

                }

                if($evidencias->save($evidencia)) {
                    //$this->Flash->success(__('The evidencia has been saved.'));
                    //return $this->redirect(['action' => 'index']);
                    $mensaje .= ". La evidencia se ha guardado correctamente.";
                    $result = true;

                }else{
                    $mensaje .= ". La evidencia no ha podido guardarse.";
                    $result = false;
                }   
            }
            echo json_encode(array('result' => $result, 'mensaje' => $mensaje));
        }
    }
    
    // Elimina evidencia para Requisitos y Méritos.
    public function deleteEvidenciaRequisito() {        
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        
        if ($this->request->is('post')) {
            
            $evidencias = TableRegistry::get('Evidencias'); 
            $evidencia = $evidencias 
                ->find()
                ->where(['id = '.$_POST['id_evidencia']])
                ->first();

            if ($evidencias->delete($evidencia)) {
                 $result = true;
		         echo json_encode(array('result' => $result)); 
            } else {
                $result = false;
		        echo json_encode(array('result' => $result)); 
            }
        }
    }  
    
    //Validamos el Div de Requisitos (valido_evidencias_requisitos = 1) para pasar al div de méritos
    public function validateDivRequisitos(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 

            $solicitudesTable = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudesTable->get($id_solicitud);
            
            $solicitud->valido_evidencias_requisitos = 1;
            
            if($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    /*
     * CREA solicitud_has_merito Y evidencia:
     *  1º-> Comprueba si existe registro en la tabla "solicitud_has_requisito". Si no existe lo crea.
     *  2º-> Añade el archivo a la tabla "evidencias" con el id de solicitud_has_requisito que se ha creado
     *       o se ha chekeado que existe.
     */
	public function savemeritoevidencia() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $merito_id = $_POST['merito_id']; 
            $solicitud_id = $_POST['solicitud_id']; 
            $descripcion = $_POST['Descripcion']; 
        
            $solicitud_has_meritos = TableRegistry::get("SolicitudHasMeritos");
            $solicitud_has_merito = $solicitud_has_meritos
                ->find()
                ->where(['solicitude_id = '.$solicitud_id.' AND merito_id = '.$merito_id])
                ->first();
            
            if(is_null($solicitud_has_merito)) {
                $solicitud_has_merito = $solicitud_has_meritos->newEntity();
                
                $solicitud_has_merito->solicitude_id = $solicitud_id;
                $solicitud_has_merito->merito_id = $merito_id;
                
                if($solicitud_has_meritos->save($solicitud_has_merito)) {
                    $mensaje = "Se ha creado la solicitud_has_merito con id = ".$solicitud_has_merito->id;
                    
                    //Creamos la evidencia
                    $evidencias = TableRegistry::get("Evidencias");
                    $evidencia = $evidencias->newEntity();
                    
                    if($this->request->data['MeritoArchivo']['error'] != 0)	{
                        $mensaje .= ". No se ha podido crear el archivo por error en la subida = ".$this->request->data['MeritoArchivo']['error'];
                        $result = false;
                        
                    }else
                    {
 
                        $info = pathinfo($this->request->data['MeritoArchivo']['name']);
                        $extension = strtolower($info['extension']);
                        $name = $info['filename'];
                        $size = ($this->request->data['MeritoArchivo']['size']);                        
                        $imgData = base64_encode(file_get_contents($this->request->data['MeritoArchivo']['tmp_name']));
                        
                        $evidencia->evidencia = $imgData;
                        $evidencia->descripcionEvidencia = $this->request->data['Descripcion']; 
                        $evidencia->nombre_archivo = $name;
                        $evidencia->extension = $extension;
                        $evidencia->tamanho = $size;
                        $evidencia->solicitud_has_meritos_id = $solicitud_has_merito->id; 
                        if(isset($this->request->data['reclamacion_id']) && ($this->request->data['reclamacion_id'] != "")){
                            $evidencia->reclamacion_id = $this->request->data['reclamacion_id'];
                        }                        
                    }

                    if($evidencias->save($evidencia)) {
                        //$this->Flash->success(__('The evidencia has been saved.'));
                        //return $this->redirect(['action' => 'index']);
                        $mensaje .= ". La evidencia se ha guardado correctamente.";
                        $result = true;
                        
                    }else{
                        $mensaje .= ". La evidencia no ha podido guardarse.";
                        $result = false;
                    }   
         
                }else {
                    $result = false;
                    $mensaje = "No se ha podido crear la solicitud_has_merito";
                }
                
            }else {
                $result = true;
                $mensaje = "solicitud_has_merito ya existente, con id = ".$solicitud_has_merito->id;
                
                //Creamos la evidencia
                $evidencias = TableRegistry::get("Evidencias");
                $evidencia = $evidencias->newEntity();

                if($this->request->data['MeritoArchivo']['error'] != 0)	{
                    $mensaje .= ". No se ha podido crear el archivo por error en la subida = ".$this->request->data['MeritoArchivo']['error'];
                    $result = false;

                }else
                {

                    $info = pathinfo($this->request->data['MeritoArchivo']['name']);
                    $extension = strtolower($info['extension']);
                    $name = $info['filename'];
                    $size = ($this->request->data['MeritoArchivo']['size']);                        
                    $imgData = base64_encode(file_get_contents($this->request->data['MeritoArchivo']['tmp_name']));

                    $evidencia->evidencia = $imgData;
                    $evidencia->descripcionEvidencia = $descripcion;
                    $evidencia->nombre_archivo = $name;
                    $evidencia->extension = $extension;
                    $evidencia->tamanho = $size;
                    $evidencia->solicitud_has_meritos_id = $solicitud_has_merito->id;
                    if(isset($_POST['reclamacion_id']) && ($_POST['reclamacion_id'] != "")){
                         $evidencia->reclamacion_id = $_POST['reclamacion_id'];
                    }                     
                }

                if($evidencias->save($evidencia)) {
                    //$this->Flash->success(__('The evidencia has been saved.'));
                    //return $this->redirect(['action' => 'index']);
                    $mensaje .= ". La evidencia se ha guardado correctamente.";
                    $result = true;

                }else{
                    $mensaje .= ". La evidencia no ha podido guardarse.";
                    $result = false;
                }   
            }
            echo json_encode(array('result' => $result, 'mensaje' => $mensaje));
        }
    }
    
    //Añadir solicitud_has_merito
    public function addsolicitudhasmerito(){
        $this->autoRender = false;
             
        if ($this->request->is('post')) {
            $solicitude_id = $_POST['solicitude_id'];
            $merito_id = $_POST['merito_id'];
           	
            $solicitud_has_meritos = TableRegistry::get('SolicitudHasMeritos');
            $solicitud = $solicitud_has_meritos->newEntity();
            
            $solicitud->solicitude_id = $solicitude_id;
            $solicitud->merito_id = $merito_id;

            if ($solicitud_has_meritos->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
            echo json_encode(array('result' => $result));  
        }    
    }
    
    //Añade la puntuación a solicitud_has_merito
    public function addmeritopuntuacion() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id = $_POST['id']; 
            $puntuacion = $_POST['puntuacion']; 
            
            $solicitud_has_meritos = TableRegistry::get("SolicitudHasMeritos");
            $solicitud_has_merito = $solicitud_has_meritos->get($id);
            
            $solicitud_has_merito->puntuacion = $puntuacion;
            
            if($solicitud_has_meritos->save($solicitud_has_merito)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    //Validamos el Div de Meritos (valido_evidencias_meritos = 1) para finalizar con el proceso.
    public function validateDivMeritos(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 

            $solicitudesTable = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudesTable->get($id_solicitud);
            
            $solicitud->valido_evidencias_meritos = 1;
            
            if($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    //añadimos la descripcion de reclamacion
    public function añadirdescripcion(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_reclamacion = $_POST['id_reclamacion'];
            $descripcion = $_POST['descripcion'];

            $reclamacionesTable = TableRegistry::get("Reclamaciones");
            $reclamacion = $reclamacionesTable->get($id_reclamacion);
                
            $reclamacion->descripcion = $descripcion;
                
            if($reclamacionesTable->save($reclamacion)) {
                $result = true;
            }else {
                $result = false;
            }                        
        }
        echo json_encode(array('result' => $result));    
    }
    
    //finalizamos el proceso de reclamar admision
    public function terminarReclamacionAdmision(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 

            $solicitudesTable = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudesTable->get($id_solicitud);
            
            $solicitud->fechaReclamacion = date("Y-m-d H:i:s");
            
            if($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));    
    }
    
    //finalizamos el proceso de reclamar evaluacion
    public function terminarReclamacionEvaluacion(){
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id_solicitud = $_POST['id_solicitud']; 
            $solicitudesTable = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudesTable->get($id_solicitud);
            
            $solicitud->fechaReclamacionEvaluacion = date("Y-m-d H:i:s");
            
            if($solicitudesTable->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));    
    } 
    
    //Añade la puntuación de conocimiento
    public function conocimientopuntuacion() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id = $_POST['id']; 
            $puntuacion = $_POST['puntuacion']; 
            
            $solicitudes = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudes->get($id);
            
            $solicitud->puntuacionConocimiento = $puntuacion;
            
            if($solicitudes->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    //Añade la puntuación de psicotecnico
    public function psicotecnicopuntuacion() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id = $_POST['id']; 
            $puntuacion = $_POST['puntuacion']; 
            
            $solicitudes = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudes->get($id);
            
            $solicitud->puntuacionPsicotecnico = $puntuacion;
            
            if($solicitudes->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result));  
    }
    
    //Añade la puntuación de entrevista
    public function entrevistapuntuacion() {
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            $id = $_POST['id']; 
            $puntuacion = $_POST['puntuacion']; 
            
            $solicitudes = TableRegistry::get("Solicitudes");
            $solicitud = $solicitudes->get($id);
            
            $solicitud->puntuacionEntrevista = $puntuacion;
            
            if($solicitudes->save($solicitud)) {
                $result = true;
            }else {
                $result = false;
            }
        }
        echo json_encode(array('result' => $result)); 
    }    
    
}