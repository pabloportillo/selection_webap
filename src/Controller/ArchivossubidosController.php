<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Archivossubidos Controller
 *
 * @property \App\Model\Table\ArchivossubidosTable $Archivossubidos
 *
 * @method \App\Model\Entity\Archivossubido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArchivossubidosController extends AppController
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
        $archivossubidos = $this->paginate($this->Archivossubidos);

        $this->set(compact('archivossubidos'));
    }

    /**
     * View method
     *
     * @param string|null $id Archivossubido id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $archivossubido = $this->Archivossubidos->get($id, [
            'contain' => ['Convocatorias']
        ]);

        $this->set('archivossubido', $archivossubido);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $archivossubido = $this->Archivossubidos->newEntity();
        if ($this->request->is('post')) {
            $archivo = $this->request->data['archivo'];
            $Uploads = new UploadsController;        
            $this->request->data['archivo'] = $Uploads->subidaArchivo($archivo);
            $archivossubido = $this->Archivossubidos->patchEntity($archivossubido, $this->request->getData());
            $archivossubido['Archivo'] = $this->request->data['archivo'];
		
            if ($this->Archivossubidos->save($archivossubido)) {

                return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view', $_POST['convocatoria_id'],'success_add_file' => 1]);
            }
            $this->Flash->error(__('The archivossubido could not be saved. Please, try again.'));
        }
        $convocatorias = $this->Archivossubidos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('archivossubido', 'convocatorias'));
    }

    /** 
     * Edit method
     *
     * @param string|null $id Archivossubido id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $archivossubido = $this->Archivossubidos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $archivossubido = $this->Archivossubidos->patchEntity($archivossubido, $this->request->getData());
            if (isset($this->request['data']['newarchivo'])) {
                
                $Uploads = new UploadsController;
                $archivossubido['Archivo'] = $Uploads->subidaArchivo($this->request['data']['newarchivo']);
                
            }

            if ($this->Archivossubidos->save($archivossubido)) {

                return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view', $_POST['convocatoria_id'],'success_edit_file' => 1]);
            }
            $this->Flash->error(__('The archivossubido could not be saved. Please, try again.'));
        }
        $convocatorias = $this->Archivossubidos->Convocatorias->find('list', ['limit' => 200]);
        $this->set(compact('archivossubido', 'convocatorias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Archivossubido id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $archivossubido = $this->Archivossubidos->get($id);
        if ($this->Archivossubidos->delete($archivossubido)) {
            return $this->redirect(['controller' => 'Convocatorias', 'action' => 'view', $_GET['convocatoria_id'],'success_delete_file' => 1]);
        } else {
            $this->Flash->error(__('The archivossubido could not be deleted. Please, try again.'));
        }

        
    }

    public function download($id=null) {
        $this->autoRender = false;

    $fileName = ltrim($_GET['archivo'], '/');

    $this->response->file(WWW_ROOT."upload/files/".$fileName ,
        array('download'=> true, 'name'=> $str = ltrim($fileName, '/')));
    }
}
