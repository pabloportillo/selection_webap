<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Meritos Controller
 *
 * @property \App\Model\Table\MeritosTable $Meritos
 *
 * @method \App\Model\Entity\Merito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MeritosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	
	/** 
     * PORTILLO
     *
	 *
	 * El index() va a recibir como paramentro el utimo digito de la URL (que le envio la id de la convocatoria (mirar vista de convocatoria)) y con el id de la convocatoria hacemos la query para que haga un listado.
	 *
	 *
     */
	
    public function index($id_convocatoria = null)
    {
        $this->paginate = [
            'contain' => ['Convocatorias', 'Categorias']
        ];
		
		if($id_convocatoria != null)
		{	
			$query = $this->Meritos->find('all')->where(['Meritos.convocatoria_id' => $id_convocatoria]);
			
			$meritos = $this->paginate($query);
			
			$this->set(compact('meritos'));
			
		} else
		{
			$meritos = $this->paginate($this->Meritos);

			$this->set(compact('meritos'));	
		}
    }

    /**
     * View method
     *
     * @param string|null $id Merito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $merito = $this->Meritos->get($id, [
            'contain' => ['Convocatorias', 'Categorias']
        ]);

        $this->set('merito', $merito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$id_convocatoria = $_GET['id'];
        
        $tipo = $_GET['tipo'];
        $this->set('tipo', $tipo);
				
        $merito = $this->Meritos->newEntity();
        if ($this->request->is('post')) {
            $merito = $this->Meritos->patchEntity($merito, $this->request->getData());
            
            $merito->tipos_meritos_id = $this->request->getData('tipo_merito');
            
            if ($this->Meritos->save($merito)) {

                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_merito' => 1]);
            }
            $fail_add = 'El merito no ha podido guardarse. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
        }
        $convocatorias = $this->Meritos->Convocatorias->find('list', ['limit' => 200]);
        //$categorias = $this->Meritos->Categorias->find('list', ['limit' => 200]);
		
		/*
		* PORTILLO
		*
		* HACE UN SELECT DE LAS CATEGORIAS QUE PERTENECEN A LA CONVOCATORIA CON LA QUE SE ESTÁ TRABAJANDO. 
		*
		*/
			
		$categorias = $this->Meritos->Categorias->find('list', ['valueField' => 'Descripcion'])->where(['convocatoria_id' => $id_convocatoria]);

        $this->set(compact('merito', 'convocatorias', 'categorias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Merito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$id_convocatoria = $_GET['id'];
		
        $merito = $this->Meritos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $merito = $this->Meritos->patchEntity($merito, $this->request->getData());
            
            $merito->tipos_meritos_id = $this->request->data['tipo_merito'];
            
            if ($this->Meritos->save($merito)) {

                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_merito' => 1]);
            }
            $fail_add = 'El merito no ha podido guardarse. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
        }
        $convocatorias = $this->Meritos->Convocatorias->find('list', ['limit' => 200]);
		/*
		* PORTILLO
		*
		* Para poner el valor del campo de otra tabla en vez del id :
		* 	1. Primero cargamos el modelo con el que queremos trabajar.
		*	2. luego hacemos un find('list') y el select tal y como se ve abajo.
		*/
		
		$categorias = $this->Meritos->Categorias->find('list', ['valueField' => 'Descripcion'])->where(['convocatoria_id' => $id_convocatoria]);

        $this->set(compact('merito', 'convocatorias', 'categorias'));
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Merito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $merito = $this->Meritos->get($id);
        if ($this->Meritos->delete($merito)) {
            return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view',$_GET['convocatoria_id'], 'success_delete_requisito' => 1]);			
        } else {
            $this->Flash->error(__('El merito no se ha borrado. Por favor, intentelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}