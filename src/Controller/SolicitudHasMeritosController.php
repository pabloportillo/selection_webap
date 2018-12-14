<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SolicitudHasMeritos Controller
 *
 * @property \App\Model\Table\SolicitudHasMeritosTable $SolicitudHasMeritos
 *
 * @method \App\Model\Entity\SolicitudHasMerito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolicitudHasMeritosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Solicitudes', 'Meritos', 'Evidencias']
        ];
        $solicitudHasMeritos = $this->paginate($this->SolicitudHasMeritos);

        $this->set(compact('solicitudHasMeritos'));
    }

    /**
     * View method
     *
     * @param string|null $id Solicitud Has Merito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solicitudHasMerito = $this->SolicitudHasMeritos->get($id, [
            'contain' => ['Solicitudes', 'Meritos', 'Evidencias']
        ]);

        $this->set('solicitudHasMerito', $solicitudHasMerito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solicitudHasMerito = $this->SolicitudHasMeritos->newEntity();
        if ($this->request->is('post')) {
            $solicitudHasMerito = $this->SolicitudHasMeritos->patchEntity($solicitudHasMerito, $this->request->getData());
            if ($this->SolicitudHasMeritos->save($solicitudHasMerito)) {
                $this->Flash->success(__('The solicitud has merito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitud has merito could not be saved. Please, try again.'));
        }
        $solicitudes = $this->SolicitudHasMeritos->Solicitudes->find('list', ['limit' => 200]);
        $meritos = $this->SolicitudHasMeritos->Meritos->find('list', ['limit' => 200]);
        $evidencias = $this->SolicitudHasMeritos->Evidencias->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasMerito', 'solicitudes', 'meritos', 'evidencias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Solicitud Has Merito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solicitudHasMerito = $this->SolicitudHasMeritos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $solicitudHasMerito = $this->SolicitudHasMeritos->patchEntity($solicitudHasMerito, $this->request->getData());
            if ($this->SolicitudHasMeritos->save($solicitudHasMerito)) {
                $this->Flash->success(__('The solicitud has merito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solicitud has merito could not be saved. Please, try again.'));
        }
        $solicitudes = $this->SolicitudHasMeritos->Solicitudes->find('list', ['limit' => 200]);
        $meritos = $this->SolicitudHasMeritos->Meritos->find('list', ['limit' => 200]);
        $evidencias = $this->SolicitudHasMeritos->Evidencias->find('list', ['limit' => 200]);
        $this->set(compact('solicitudHasMerito', 'solicitudes', 'meritos', 'evidencias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Solicitud Has Merito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solicitudHasMerito = $this->SolicitudHasMeritos->get($id);
        if ($this->SolicitudHasMeritos->delete($solicitudHasMerito)) {
            $this->Flash->success(__('The solicitud has merito has been deleted.'));
        } else {
            $this->Flash->error(__('The solicitud has merito could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
