<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SolicitudHasRequisitos Controller
 *
 * @property \App\Model\Table\SolicitudHasRequisitosTable $SolicitudHasRequisitos
 *
 * @method \App\Model\Entity\SolicitudHasRequisito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudHasRequisitosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Solicitudes', 'Requisitos', 'Evidencias']
        ];
        $solicitudHasRequisitos = $this->paginate($this->SolicitudHasRequisitos);

        $this->set(compact('solicitudHasRequisitos'));
    }

    /**
     * View method
     *
     * @param string|null $id Solicitud Has Requisito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solicitudHasRequisito = $this->SolicitudHasRequisitos->get($id, [
            'contain' => ['Solicitudes', 'Requisitos', 'Evidencias']
        ]);

        $this->set('solicitudHasRequisito', $solicitudHasRequisito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solicitudHasRequisito = $this->SolicitudHasRequisitos->newEntity();
        if ($this->request->is('post')) {
            $solicitudHasRequisito = $this->SolicitudHasRequisitos->patchEntity($solicitudHasRequisito, $this->request->getData());
            if ($this->SolicitudHasRequisitos->save($solicitudHasRequisito)) {
                $this->Flash->success(__('The solicitud has requisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitud has requisito could not be saved. Please, try again.'));
        }
        $solicitudes = $this->SolicitudHasRequisitos->Solicitudes->find('list', ['limit' => 200]);
        $requisitos = $this->SolicitudHasRequisitos->Requisitos->find('list', ['limit' => 200]);
        $evidencias = $this->SolicitudHasRequisitos->Evidencias->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasRequisito', 'solicitudes', 'requisitos', 'evidencias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Solicitud Has Requisito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitudHasRequisito = $this->SolicitudHasRequisitos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitudHasRequisito = $this->SolicitudHasRequisitos->patchEntity($solicitudHasRequisito, $this->request->getData());
            if ($this->SolicitudHasRequisitos->save($solicitudHasRequisito)) {
                $this->Flash->success(__('The solicitud has requisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitud has requisito could not be saved. Please, try again.'));
        }
        $solicitudes = $this->SolicitudHasRequisitos->Solicitudes->find('list', ['limit' => 200]);
        $requisitos = $this->SolicitudHasRequisitos->Requisitos->find('list', ['limit' => 200]);
        $evidencias = $this->SolicitudHasRequisitos->Evidencias->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasRequisito', 'solicitudes', 'requisitos', 'evidencias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Solicitud Has Requisito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solicitudHasRequisito = $this->SolicitudHasRequisitos->get($id);
        if ($this->SolicitudHasRequisitos->delete($solicitudHasRequisito)) {
            $this->Flash->success(__('The solicitud has requisito has been deleted.'));
        } else {
            $this->Flash->error(__('The solicitud has requisito could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
