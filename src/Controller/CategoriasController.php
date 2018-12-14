<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categorias Controller
 *
 * @property \App\Model\Table\CategoriasTable $Categorias
 *
 * @method \App\Model\Entity\Categoria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	
    public function index($id_convocatoria = null)
    {
        $this->paginate = [
            'contain' => ['Convocatorias']
        ];
		
		if($id_convocatoria != null)
		{
			$query = $this->Categorias->find('all')->where(['Categorias.convocatoria_id' => $id_convocatoria]);
			
			$categorias = $this->paginate($query);
			
			$this->set(compact('categorias'));	
			
		} else
		{
			$categorias = $this->paginate($this->Categorias);

			$this->set(compact('categorias'));	
		}
    }

    /**
     * View method
     *
     * @param string|null $id Categoria id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoria = $this->Categorias->get($id, [
            'contain' => ['Convocatorias', 'Meritos']
        ]);

        $this->set('categoria', $categoria);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoria = $this->Categorias->newEntity();
        if ($this->request->is('post')) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->getData());
            if ($this->Categorias->save($categoria)) {

                return $this->redirect(['controller' => 'Convocatorias','action' => 'view',$_POST['convocatoria_id'],'success_add_category' => 1]);
            }
            $fail_add = 'La categoria no ha podido guardarse. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
        }
        $convocatorias = $this->Categorias->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('categoria', 'convocatorias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoria = $this->Categorias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->getData());
            if ($this->Categorias->save($categoria)) {

                return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view',$_POST['convocatoria_id'],'success_edit_category' => 1]);
            }
			$fail_add = 'La categoria no ha podido guardarse. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
        }
        $convocatorias = $this->Categorias->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('categoria', 'convocatorias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categoria id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $categoria = $this->Categorias->get($id);

        $this->loadModel('Meritos');
        $this->Meritos->deleteAll(['categoria_id' => $id]);
		
        if ($this->Categorias->delete($categoria)) {
            return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view',$_GET['convocatoria_id'], 'success_delete_category' => 1]);

        } else {
            $this->Flash->error(__('La categoria no pudo borrarse. Por favor, intentelo de nuevo.'));
        }

    }
}
