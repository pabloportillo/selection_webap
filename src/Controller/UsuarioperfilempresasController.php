<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Usuarioperfilempresas Controller
 *
 * @property \App\Model\Table\UsuarioperfilempresasTable $Usuarioperfilempresas
 *
 * @method \App\Model\Entity\Usuarioperfilempresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioperfilempresasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $usuarioperfilempresas = $this->paginate($this->Usuarioperfilempresas);

        $this->set(compact('usuarioperfilempresas'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuarioperfilempresa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuarioperfilempresa = $this->Usuarioperfilempresas->get($id, [
            'contain' => []
        ]);

        $this->set('usuarioperfilempresa', $usuarioperfilempresa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuarioperfilempresa = $this->Usuarioperfilempresas->newEntity();
        if ($this->request->is('post')) {
            $usuarioperfilempresa = $this->Usuarioperfilempresas->patchEntity($usuarioperfilempresa, $this->request->getData());
            if ($this->Usuarioperfilempresas->save($usuarioperfilempresa)) {
                $this->Flash->success(__('The usuarioperfilempresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuarioperfilempresa could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioperfilempresa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuarioperfilempresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuarioperfilempresa = $this->Usuarioperfilempresas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuarioperfilempresa = $this->Usuarioperfilempresas->patchEntity($usuarioperfilempresa, $this->request->getData());
            if ($this->Usuarioperfilempresas->save($usuarioperfilempresa)) {
                $this->Flash->success(__('The usuarioperfilempresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuarioperfilempresa could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioperfilempresa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuarioperfilempresa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuarioperfilempresa = $this->Usuarioperfilempresas->get($id);
        if ($this->Usuarioperfilempresas->delete($usuarioperfilempresa)) {
            $this->Flash->success(__('The usuarioperfilempresa has been deleted.'));
        } else {
            $this->Flash->error(__('The usuarioperfilempresa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
