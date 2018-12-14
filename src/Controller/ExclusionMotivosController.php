<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExclusionMotivos Controller
 *
 * @property \App\Model\Table\ExclusionMotivosTable $ExclusionMotivos
 *
 * @method \App\Model\Entity\ExclusionMotivo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExclusionMotivosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Convocatorias']
        ];
        $exclusionMotivos = $this->paginate($this->ExclusionMotivos);

        $this->set(compact('exclusionMotivos'));
    }

    /**
     * View method
     *
     * @param string|null $id Exclusion Motivo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exclusionMotivo = $this->ExclusionMotivos->get($id, [
            'contain' => ['Convocatorias', 'SolicitudHasExclusionMotivos']
        ]);

        $this->set('exclusionMotivo', $exclusionMotivo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exclusionMotivo = $this->ExclusionMotivos->newEntity();
        if ($this->request->is('post')) {
            $exclusionMotivo = $this->ExclusionMotivos->patchEntity($exclusionMotivo, $this->request->getData());
			
            if ($this->ExclusionMotivos->save($exclusionMotivo)) {
                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_exclusionMotivo' => 1]);
            }
            $this->Flash->error(__('The exclusion motivo could not be saved. Please, try again.'));
        }
        $convocatorias = $this->ExclusionMotivos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('exclusionMotivo', 'convocatorias'));
    }
	
    /**
     * Edit method
     *
     * @param string|null $id Exclusion Motivo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exclusionMotivo = $this->ExclusionMotivos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exclusionMotivo = $this->ExclusionMotivos->patchEntity($exclusionMotivo, $this->request->getData());
            if ($this->ExclusionMotivos->save($exclusionMotivo)) {
                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_edit_exclusionMotivo' => 1]);
            }
            $this->Flash->error(__('The exclusion motivo could not be saved. Please, try again.'));
        }
        $convocatorias = $this->ExclusionMotivos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('exclusionMotivo', 'convocatorias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exclusion Motivo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exclusionMotivo = $this->ExclusionMotivos->get($id);

        if ($this->ExclusionMotivos->delete($exclusionMotivo)) {
            return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view',$_GET['convocatoria_id'], 'success_delete_exclusionMotivo' => 1]);
        } else {
            $this->Flash->error(__('The exclusion motivo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}