<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Requisitos Controller
 *
 * @property \App\Model\Table\RequisitosTable $Requisitos
 *
 * @method \App\Model\Entity\Requisito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequisitosController extends AppController
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
            'contain' => ['Convocatorias']
        ];
		
		if($id_convocatoria != null)
		{

			/*
			 * Esta query también vale
			 * $query = $this->Requisitos->find('all',['conditions' => ['convocatoria_id' => $id_convocatoria]]);
			*/
			
			$query = $this->Requisitos->find('all')->where(['convocatoria_id' => $id_convocatoria]);
			
			$requisitos = $this->paginate($query);
			
			$this->set(compact('requisitos'));

		} else 
		{
					
			$requisitos = $this->paginate($this->Requisitos);

			$this->set(compact('requisitos'));
		}
		

    }

    /**
     * View method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requisito = $this->Requisitos->get($id, [
            'contain' => ['Convocatorias']
        ]);

        $this->set('requisito', $requisito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {		
        $requisito = $this->Requisitos->newEntity();
        if ($this->request->is('post')) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
			
	
            if ($this->Requisitos->save($requisito)) {

                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_requisito' => 1]);
            }
            $this->Flash->error(__('El requisito no pudo guardarse. Por favor, intentelo de nuevo.'));
        }
        $convocatorias = $this->Requisitos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('requisito', 'convocatorias'));
    }
	
    /**
     * Edit method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requisito = $this->Requisitos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requisito = $this->Requisitos->patchEntity($requisito, $this->request->getData());
            if ($this->Requisitos->save($requisito)) {

                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_requisito' => 1]);
            }
            $this->Flash->error(__('El requisito no pudo guardarse. Por favor, intentelo de nuevo.'));
        }
        $convocatorias = $this->Requisitos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('requisito', 'convocatorias'));
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Requisito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisito = $this->Requisitos->get($id);
        if ($this->Requisitos->delete($requisito)) {
            return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view',$_GET['convocatoria_id'], 'success_delete_requisito' => 1]);
        } else {
            $this->Flash->error(__('El requisito no pudo borrarse. Por favor, intentelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}