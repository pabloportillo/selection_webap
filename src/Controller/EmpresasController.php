<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Empresas Controller
 *
 * @property \App\Model\Table\EmpresasTable $Empresas
 *
 * @method \App\Model\Entity\Empresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpresasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $empresas = $this->paginate($this->Empresas);

        $this->set(compact('empresas'));
    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => []
        ]);

        $this->set('empresa', $empresa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empresa = $this->Empresas->newEntity();
        if ($this->request->is('post')) {
			
            $archivo = $this->request->data['DeclaracionResponsable'];
            $Uploads = new UploadsController;        
            $this->request->data['DeclaracionResponsable'] = $Uploads->subidaArchivo($archivo);
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
            $empresa['DeclaracionResponsable'] = $this->request->data['DeclaracionResponsable'];
			
            if ($this->Empresas->save($empresa)) {

                return $this->redirect(['action' => 'index','success_add' => 1]);
            }
            $fail_add = 'Los datos no se pudieron guardar. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_add'));
        }
        $this->set(compact('empresa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
			
            if (isset($this->request['data']['newarchivo'])) {
                
                $Uploads = new UploadsController;
                $empresa['DeclaracionResponsable'] = $Uploads->subidaArchivo($this->request['data']['newarchivo']);
                
            }
			
            if ($this->Empresas->save($empresa)) {

                return $this->redirect(['action' => 'index','success_edit' => 1]);
            }
            $fail_edit = 'Los datos no se pudieron guardar. Por favor, intentelo de nuevo.';
            $this->set(compact('fail_edit'));
        }
        $this->set(compact('empresa'));
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empresa = $this->Empresas->get($id);
        if ($this->Empresas->delete($empresa)) {
            return $this->redirect(['action' => 'index','success_delete' => 1]);
        } else {
            return $this->redirect(['action' => 'index','fail_delete' => 1]);
        }

        
    }
}