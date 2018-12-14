<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Correos Controller
 *
 *
 * @method \App\Model\Entity\Correo[] paginate($object = null, array $settings = [])
 */
class CorreosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function enviarcorreo($tipo, $nombre_persona,$email_user, $descripcion){
        //$this->loadModel('Log');
    try {
            $Email = new Email('default');

            $Email->emailFormat('html');
            $Email->from(['no-reply@ingenia.es' => 'Plataforma de selección']);

                switch ($tipo) {
                    case 1: 
                        $Email->subject('[Plataforma de selección] Recuperación de contraseña ');
                        $Email->template('recuperarClave', 'default');
                        $Email->viewVars(array('email_user' =>$email_user ,'nombre_persona' => $nombre_persona, 'descripcion' => $descripcion));
                        //$Email->to($email_user); 
                        $Email->to($email_user);                       
                        //$Email->addTo('soportenovocare@ingeniaglobal.cl');
                    break;
                }
               

               if (!$Email->send()) {
                echo "Error al enviar email";
                die();
               } 
            } catch(Exception $e) {
            $this->Session->setFlash(__('Could not invite guests. Probably a bad email. Please, try again.'), 'flash/error');
        }
          
           
       }

}
