<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SolicitudHasExclusionMotivos Controller
 *
 * @property \App\Model\Table\SolicitudHasExclusionMotivosTable $SolicitudHasExclusionMotivos
 *
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudHasExclusionMotivosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ExclusionMotivos', 'Solicitudes']
        ];
        $solicitudHasExclusionMotivos = $this->paginate($this->SolicitudHasExclusionMotivos);

        $this->set(compact('solicitudHasExclusionMotivos'));
    }

    /**
     * View method
     *
     * @param string|null $id Solicitud Has Exclusion Motivo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->get($id, [
            'contain' => ['ExclusionMotivos', 'Solicitudes']
        ]);

        $this->set('solicitudHasExclusionMotivo', $solicitudHasExclusionMotivo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->newEntity();
        if ($this->request->is('post')) {
            $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->patchEntity($solicitudHasExclusionMotivo, $this->request->getData());
            if ($this->SolicitudHasExclusionMotivos->save($solicitudHasExclusionMotivo)) {
                $this->Flash->success(__('The solicitud has exclusion motivo has been saved.'));

                return $this->redirect($this->referer());
				//return $this->redirect(['controller' => 'Solicitudes','action' => 'view', 'success_add' => 1]);
				
            }
            $this->Flash->error(__('The solicitud has exclusion motivo could not be saved. Please, try again.'));
        }
        $exclusionMotivos = $this->SolicitudHasExclusionMotivos->ExclusionMotivos->find('list', ['limit' => 200]);
        $solicitudes = $this->SolicitudHasExclusionMotivos->Solicitudes->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasExclusionMotivo', 'exclusionMotivos', 'solicitudes'));
    }
    
    // AÑADE POR AJAX MOTIVO DE EXCLUSIÓN DESDE LA VISTA DE SOLICITUDES
    public function addbyajax() {
        
        $this->autoRender = false;
        
        if ($this->request->is('post')) {
            
            $solicitudHasExclusionMotivos = TableRegistry::get("SolicitudHasExclusionMotivos");
            $solicitudHasExclusionMotivo = $solicitudHasExclusionMotivos->newEntity();
            
            $solicitudHasExclusionMotivo->exclusion_motivo_id = $_POST['exclusion_motivo_id'];
            $solicitudHasExclusionMotivo->solicitude_id = $_POST['solicitude_id'];
            
            if($solicitudHasExclusionMotivos->save($solicitudHasExclusionMotivo)) {
                $result = true;
		        echo json_encode(array('result' => $result)); 
            }else {
                $result = false;
		        echo json_encode(array('result' => $result)); 
            }
        }
    } 
         
    // ELIMINA POR AJAX MOTIVO DE EXCLUSIÓN DESDE LA VISTA DE SOLICITUDES
    public function deletebyajax() {
        
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        
        if ($this->request->is('post')) {
            
            $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->get($_POST['exclusion_motivo_id']);
            
            if ($this->SolicitudHasExclusionMotivos->delete($solicitudHasExclusionMotivo)) {
                 $result = true;
		         echo json_encode(array('result' => $result)); 
            } else {
                $result = false;
		        echo json_encode(array('result' => $result)); 
            }
        }
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Solicitud Has Exclusion Motivo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->patchEntity($solicitudHasExclusionMotivo, $this->request->getData());
            if ($this->SolicitudHasExclusionMotivos->save($solicitudHasExclusionMotivo)) {
                $this->Flash->success(__('The solicitud has exclusion motivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitud has exclusion motivo could not be saved. Please, try again.'));
        }
        $exclusionMotivos = $this->SolicitudHasExclusionMotivos->ExclusionMotivos->find('list', ['limit' => 200]);
        $solicitudes = $this->SolicitudHasExclusionMotivos->Solicitudes->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasExclusionMotivo', 'exclusionMotivos', 'solicitudes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Solicitud Has Exclusion Motivo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		
        $solicitudHasExclusionMotivo = $this->SolicitudHasExclusionMotivos->get($id);
        if ($this->SolicitudHasExclusionMotivos->delete($solicitudHasExclusionMotivo)) {
            $this->Flash->success(__('The solicitud has exclusion motivo has been deleted.'));
        } else {
            $this->Flash->error(__('The solicitud has exclusion motivo could not be deleted. Please, try again.'));
        }

        $this->redirect($this->referer());
    }
}