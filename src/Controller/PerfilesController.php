<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Perfiles Controller
 *
 * @property \App\Model\Table\PerfilesTable $Perfiles
 *
 * @method \App\Model\Entity\Perfile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PerfilesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $perfiles = $this->paginate($this->Perfiles->find('all', array('order' => array('id' => 'asc'))));

        $this->set(compact('perfiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $perfile = $this->Perfiles->get($id, [
            'contain' => []
        ]);

        $this->set('perfile', $perfile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $perfile = $this->Perfiles->newEntity();
		
        $this->loadModel('Acciones');
        $acciones = $this->Acciones->find('all')
        ->toArray();
		
		$this->loadModel('PerfilAcciones');
        $PerfilAcciones = $this->PerfilAcciones->find('all')
        ->toArray();
		
        if ($this->request->is('post')) {
			$idultimo = $this->Perfiles->find('list')
             ->order(['id' => 'DESC'])
             ->limit('1')
             ->select(['id'])->toArray();	

			$acciones = $this->request['data']['accione'];
			

            $perfile = $this->Perfiles->patchEntity($perfile, $this->request->getData());
			$perfile['id'] = current($idultimo) + 1;
			
            if ($this->Perfiles->save($perfile)) {

				foreach($acciones as $clave => $valor)
				{

					$PerfilAcciones = $this->PerfilAcciones->newEntity();
					$PerfilAcciones->perfile_id = current($idultimo) + 1;
					$PerfilAcciones->accione_id = intval($valor);
					$this->PerfilAcciones->save($PerfilAcciones);
				}
					
                return $this->redirect(['action' => 'index','success_add' => 1]);
            }
            $fail_add = 'The perfile could not be saved. Please, try again.';
            $this->set(compact('fail_add'));
        }
        $this->set(compact('perfile', 'acciones'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $perfile = $this->Perfiles->get($id, [
            'contain' => []
        ]);
		
        $this->loadModel('Acciones');
        $acciones = $this->Acciones->find('all')
        ->toArray();
		
		$this->loadModel('PerfilAcciones');
        $PerfilAcciones = $this->PerfilAcciones->find('all')
        ->toArray();
		
		$perfilSelect = $this->PerfilAcciones->find('all')
		->where(['perfile_id='.$id])
        ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$this->PerfilAcciones->deleteAll(['perfile_id' => $id]);
			$acciones = $this->request['data']['accione'];
			
            $perfile = $this->Perfiles->patchEntity($perfile, $this->request->getData());
            if ($this->Perfiles->save($perfile)) {
				
				
				foreach($acciones as $clave => $valor)
				{	
					
					$PerfilAcciones = $this->PerfilAcciones->newEntity();
					$PerfilAcciones->perfile_id = $perfile['id'];
					$PerfilAcciones->accione_id = intval($valor);
					$this->PerfilAcciones->save($PerfilAcciones);
				}

                return $this->redirect(['action' => 'index','success_edit' => 1]);
            }
            $fail_edit = 'The perfile could not be saved. Please, try again.';
            $this->set(compact('fail_edit'));
        }
        $this->set(compact('perfile', 'acciones', 'perfilSelect'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $perfile = $this->Perfiles->get($id);
		
		$this->loadModel('PerfilAcciones');
		$this->PerfilAcciones->deleteAll(['perfile_id' => $id]);
		
        if ($this->Perfiles->delete($perfile)) {
            return $this->redirect(['action' => 'index','success_delete' => 1]);
        } else {
            return $this->redirect(['action' => 'index','fail_delete' => 1]);
        }
     
    }
}