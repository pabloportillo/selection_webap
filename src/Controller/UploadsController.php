<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Paises Controller
 *
 * @property \App\Model\Table\PaisesTable $Paises
 */
class UploadsController extends AppController
{

    /**
     * Index method
     *
     * @retorna cabeceras de descarga de un archivo pasado por parámetro. La carpeta indicaría donde hay que buscar ese archivo. 
     */
    public function descarga()
    {			
			//Recibimos los parámetros por GET
			$parametros = ($this->request->params['pass']);			
			$carpeta = $parametros[0];	
			$nombreFichero = $parametros[1];		
			$file_path = ROOT.DS.'downloads'.DS.$carpeta.DS.$nombreFichero;
			$this->response->file($file_path, array(
				'download' => true,
				'name' => $nombreFichero,
			));
			return $this->response;
	} 

	/**
     * Upload method
     *
     * @retorna true o false en el caso de que suba un archivo pasado por parametro y retorna el nombre del archivo físico. 
     */
    public function subidaArchivo($archivo)
    {
    	
			//CARPETAS TIPOS DE ARCHIVOS
			$extension = strtolower($this->obtieneExtension($archivo['name']));
			$nombreFichero = $archivo['name'];
			/*switch ($tipoArchivo) {
				case 'consentimiento_proteccion_datos':
					$carpeta = 'consentimientos';
					$nombreFichero = 'consentimientoProteccionDatos-'.$idTicket.'.'.$extension;
					break;
				case 'consentimiento_expreso':
					$carpeta = 'consentimientos';
					$nombreFichero = 'consentimiento_expreso-'.$idTicket.'.'.$extension;
					break;
				case 'consentimientos':
					$carpeta = 'consentimientos';
					$nombreFichero = 'consentimiento-'.$idTicket.'.'.$extension;
					break;
				case 'recetas':
					$carpeta = 'recetas';
					$nombreFichero = 'recetas-'.$idTicket.'.'.$extension;
					break;
				case 'consentimiento_correos':
					$carpeta = 'consentimientos';
					$nombreFichero = 'consentimiento_correos-'.$idTicket.'.'.$extension;
					break;
				case 'imagen_destacada':
					$carpeta = 'web';
					$nombreFichero = 'imagen_destacada-'.$idTicket.'.'.$extension;
					break;
			}*/
			//$file_path = ROOT.DS.'downloads'.DS.$carpeta.DS.$nombreFichero;
			$file_path = "upload/files/".$nombreFichero;
			try {
				if (move_uploaded_file($archivo['tmp_name'], $file_path)) {
					
					return $nombreFichero;
				} else {
					return false;
				}
			} catch (Exception $e) {
				echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}
			
			
	}
	
	/**
     * compruebaFichero method
     *
     * @retorna true o false en caso de que el archivo cumpla las condicionse de formato, tamaño etc... 
     */	
	public function compruebaFichero($archivo){
			//Condiciones
			$extensionesPermitidas = array('jpg', 'jpeg', 'png', 'pdf','php');
			$tamanoMaximo = '5072000';
			$mimePermitidos = array('image/jpeg', 'application/pdf','image/png');
			
			$extension = strtolower($this->obtieneExtension($archivo['name']));			
			//Comprobaciones
			if (empty($archivo)){
				return array(false, 'Error archivo vacío');
			}
			if ($archivo['size'] > $tamanoMaximo){
				return array(false, 'Tamaño de archivo excedido');
			}
			if (!in_array($archivo['type'], $mimePermitidos)){
				return array(false, 'El archivo no está dentro de los tipos permidos');
			}
			if (!in_array($extension, $extensionesPermitidas)){
				return array(false, 'La extensión del archivo no está entre las permitidas ('.$extension.')');
			}
			return array(true, 'Archivo correcto');			
	}
	
	//Obtiene la extension del nombre de un archivo pasado por parametro //Quizás haya que comprobar archivos con varios puntos.
	private function obtieneExtension($nombreArchivo){
		$array = explode('.', $nombreArchivo);		
		$extension = end($array);
		return $extension;		
	}
}