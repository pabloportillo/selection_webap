<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Evidencias Controller
 *
 * @property \App\Model\Table\EvidenciasTable $Evidencias
 *
 * @method \App\Model\Entity\Evidencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvidenciasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $evidencias = $this->paginate($this->Evidencias);

        $this->set(compact('evidencias'));
    }

    /**
     * View method
     *
     * @param string|null $id Evidencia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evidencia = $this->Evidencias->get($id, [
            'contain' => ['SolicitudHasMeritos', 'SolicitudHasRequisitos']
        ]);

        $this->set('evidencia', $evidencia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evidencia = $this->Evidencias->newEntity();
        if ($this->request->is('post')) {
            $evidencia = $this->Evidencias->patchEntity($evidencia, $this->request->getData());
            
            $size = ($this->request->data['evidencia']['size']);
            $info = pathinfo($this->request->data['evidencia']['name']);
            $extension = strtolower($info['extension']);
            $nombre = $info['filename'];
            
            //debug($evidencia);
            echo "<br>-------------------<br>";
            //debug($info);
            //debug($evidencia2);
            
            echo $nombre;
            echo "<br>";
            echo $extension;
            echo "<br>";
            echo $size;
            echo "<br>";
            die();

            //pathinfo es para pillar información de lo que se sube. Lo que quiero es la extension.
            $info = pathinfo($evidencia['evidencia']['name']);
			
			if($this->request->data['evidencia']['error'] == 4)	{
				$evidencia['evidencia'] = null;
			}else
			{
                
                debug ($this->request->data['evidencia']);
                die();
                
                $evidencia['extension'] = strtolower($info['extension']);
				$imgData = base64_encode(file_get_contents($this->request->data['evidencia']['tmp_name']));
				$evidencia['evidencia'] = $imgData;
			}
			
            if ($this->Evidencias->save($evidencia)) {
                $this->Flash->success(__('The evidencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evidencia could not be saved. Please, try again.'));
        }
        $this->set(compact('evidencia'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Evidencia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evidencia = $this->Evidencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evidencia = $this->Evidencias->patchEntity($evidencia, $this->request->getData());
            if ($this->Evidencias->save($evidencia)) {
                $this->Flash->success(__('The evidencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evidencia could not be saved. Please, try again.'));
        }
        $this->set(compact('evidencia'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Evidencia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evidencia = $this->Evidencias->get($id);
        if ($this->Evidencias->delete($evidencia)) {
            $this->Flash->success(__('The evidencia has been deleted.'));
        } else {
            $this->Flash->error(__('The evidencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
