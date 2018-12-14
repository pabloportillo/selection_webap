<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Evaluadorsolicitanterequisitos Controller
 *
 * @property \App\Model\Table\EvaluadorsolicitanterequisitosTable $Evaluadorsolicitanterequisitos
 *
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvaluadorsolicitanterequisitosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuarios', 'Requisitos']
        ];
        $evaluadorsolicitanterequisitos = $this->paginate($this->Evaluadorsolicitanterequisitos);

        $this->set(compact('evaluadorsolicitanterequisitos'));
    }

    /**
     * View method
     *
     * @param string|null $id Evaluadorsolicitanterequisito id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->get($id, [
            'contain' => ['Usuarios', 'Requisitos']
        ]);

        $this->set('evaluadorsolicitanterequisito', $evaluadorsolicitanterequisito);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->newEntity();
        if ($this->request->is('post')) {
            $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->patchEntity($evaluadorsolicitanterequisito, $this->request->getData());
            if ($this->Evaluadorsolicitanterequisitos->save($evaluadorsolicitanterequisito)) {
                $this->Flash->success(__('The evaluadorsolicitanterequisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evaluadorsolicitanterequisito could not be saved. Please, try again.'));
        }
        $usuarios = $this->Evaluadorsolicitanterequisitos->Usuarios->find('list', ['limit' => 200]);
        $requisitos = $this->Evaluadorsolicitanterequisitos->Requisitos->find('list', ['limit' => 200]);
        $this->set(compact('evaluadorsolicitanterequisito', 'usuarios', 'requisitos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluadorsolicitanterequisito id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->patchEntity($evaluadorsolicitanterequisito, $this->request->getData());
            if ($this->Evaluadorsolicitanterequisitos->save($evaluadorsolicitanterequisito)) {
                $this->Flash->success(__('The evaluadorsolicitanterequisito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evaluadorsolicitanterequisito could not be saved. Please, try again.'));
        }
        $usuarios = $this->Evaluadorsolicitanterequisitos->Usuarios->find('list', ['limit' => 200]);
        $requisitos = $this->Evaluadorsolicitanterequisitos->Requisitos->find('list', ['limit' => 200]);
        $this->set(compact('evaluadorsolicitanterequisito', 'usuarios', 'requisitos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluadorsolicitanterequisito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluadorsolicitanterequisito = $this->Evaluadorsolicitanterequisitos->get($id);
        if ($this->Evaluadorsolicitanterequisitos->delete($evaluadorsolicitanterequisito)) {
            $this->Flash->success(__('The evaluadorsolicitanterequisito has been deleted.'));
        } else {
            $this->Flash->error(__('The evaluadorsolicitanterequisito could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
