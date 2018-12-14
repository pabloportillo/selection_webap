<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 *                
        ESTO LO MODIFICAMOS:
 <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentación</a></li>
 li><a target="_blank" href="https://api.cakephp.org/3.0/">Api</a></li>
 
 ------------------------------------------------------------------------------------------------------------------
 
  L O G O
 
------------------ IMAGE LINK ---------------
To create an image link specify the link destination using the url option in $options.

echo $this->Html->image("recipes/6.jpg", array(
    "alt" => "Brownies",
    'url' => array('controller' => 'recipes', 'action' => 'view', 6)
));


echo $this->Html->link('View image', array(
    'controller' => 'images',
    'action' => 'view',
    1,
    '?' => array('height' => 400, 'width' => 500))
)

 
 */

$cakeDescription = 'Plataforma de Selección';
//AuthComponent::user();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- 
    *
    * PORTILLO:
    *
    * Para cargar jQuery la linea de abajo:
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- 
    * 
    * PORTILLO:
    *
    * Para cargar TinyMCE text editor (editor de texto que guarda texto html enriquecido) los dos scripts de abajo:
    -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
       tinymce.init({ selector:'.edittextarea', height: 500,  plugins: [
        'advlist autolink lists link print preview anchor',
        'visualblocks code fullscreen',
        'insertdatetime table contextmenu paste code'
       ], });
    </script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--Cargo las hojas de estilo-->
    <!--<?= $this->Html->css('base.css') ?>-->
    <!--<?= $this->Html->css('cake.css') ?>-->
    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->Html->css('alertify.core.css') ?>
    <?= $this->Html->css('alertify.default.css') ?>
    <?= $this->Html->css('alertify.bootstrap.css') ?>
    <?= $this->Html->css('site.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('fontawesome-all.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.min.css') ?>
    <?= $this->Html->css('bootstrap-datepicker3.css') ?>
    <?= $this->Html->css('bootstrap-datepicker3.min.css') ?>
    <?= $this->Html->css('estilo.css') ?>

    <!--Cargo los scripts js-->
    <?= $this->Html->script('jquery.min') ?>
    <?= $this->Html->script('config') ?>
    <?= $this->Html->script('modernizr-2.6.2') ?>
    <?= $this->Html->script('datepicker_noconflict') ?>
    <?= $this->Html->script('bootstrap') ?>
    <?= $this->Html->script('bootstrap-datetimepicker') ?>
    <?= $this->Html->script('bootstrap-datetimepicker.min') ?>
    <?= $this->Html->script('locales/bootstrap-datetimepicker.es') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-datepicker.min') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('respond') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<script>    
$(document).ready(function () {

	if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 1) {
		$("#evaluaciones").remove();
        $("#convocatorias").remove();
        $("#solicitudes").remove();
	}	
	
	if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 2) {
		$("#perfiles").remove();
		$("#empresas").remove();
        $("#edit_perfil").hide();
        $("#edit_empresa").hide();
	}

	if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 3) {
		$("#usuarios").remove();
		$("#perfiles").remove();
		$("#empresas").remove();
		$("#archivos").remove();
		$("#requisitos").remove();	
		$("#categorias").remove();	
		$("#meritos").remove();
		$("#motivos").remove();
		$("#add_convocatoria").remove();
		$("#add_solicitudes").remove();  
		$("#delete_convocatoria").remove(); 
		$("#edit_convocatoria").remove();
		$("#edit_delete_archivossubidos").remove();
		$("#edit_delete_requisitos").remove();
		$("#edit_delete_categoria").remove();
		$("#edit_delete_merito").remove();
		$("#edit_delete_motivos").remove();
        $("#edit_perfil").hide();
        $("#edit_empresa").hide();
        $("#edit_activo").hide(); 
        $("#habilitarreclamacion").hide();
	}

	if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 4) {
		$("#usuarios").remove();
		$("#perfiles").remove();
        $("#gestionarsolicitudes").remove();
        $("#evaluaciones").remove();
		$("#empresas").remove();
		$("#archivos").remove();
		$("#requisitos").remove();	
		$("#categorias").remove();	
		$("#meritos").remove();
		$("#motivos").remove();
		$("#add_convocatoria").remove();
		$("#add_solicitudes").remove(); 
		$("#delete_convocatoria").remove(); 
		$("#edit_convocatoria").remove();
		$("#edit_delete_archivossubidos").remove();
		$("#edit_delete_requisitos").remove();
		$("#edit_delete_categoria").remove();
		$("#edit_delete_merito").remove();
		$("#edit_delete_motivos").remove();
        $("#edit_perfil").hide();
        $("#edit_empresa").hide();
        $("#edit_activo").hide();
        $("#add_motivo_exclusion").hide();
        $("#motivo_selected").hide();
        $("#duplicar_convocatoria").hide();
        $("#habilitarreclamacion").hide();
	}
// # porque es un id
// . porque es una clase (para que quite todos los elementos del bucle)
	
	if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 5) {
		$("#usuarios").remove();
		$("#perfiles").remove();
        $("#solicitudes").remove();
        $("#gestionarsolicitudes").remove();
        $("#evaluaciones").remove();
		$("#empresas").remove();
		$("#archivos").remove();
		$("#requisitos").remove();	
		$("#categorias").remove();	
		$("#meritos").remove();
		$("#motivos").remove();
		$("#add_convocatoria").remove();   
		$("#delete_convocatoria").remove(); 
		$("#edit_convocatoria").remove();
		$("#edit_delete_archivossubidos").remove();
		$("#edit_delete_requisitos").remove();
		$("#edit_delete_categoria").remove();
		$("#edit_delete_merito").remove();
		$("#edit_delete_motivos").remove();
        $("#edit_empresa").hide(); 
        $("#edit_perfil").hide();
        $("#edit_activo").hide();
	}  
});
	
	</script>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">
                    <?php $brand_img = $this->Html->image('ingenia.jpg', ['height' => 56]); ?>
                    <?= $this->Html->link($brand_img, array('controller' => 'Home', 'action' => 'index'), array('escape' => false)); ?>                    
                </a>
        </div>
        
        <div id="barranavegacion" class="navbar-collapse collapse" style="overflow: hidden">
        <?php if ($this->request->getSession()->read('Auth')) { ?>
        <ul class="nav navbar-nav">
                
            <li><?= $this->Html->link(__('Gestionar Usuarios'), ['controller' => 'usuarios', 'action' => 'index'],['id' => 'usuarios']) ?> </li>
            <li><?= $this->Html->link(__('Gestionar Perfiles'), ['controller' => 'perfiles', 'action' => 'index'],['id' => 'perfiles']) ?> </li>
            <li><?= $this->Html->link(__('Gestionar Empresas'), ['controller' => 'empresas', 'action' => 'index'],['id' => 'empresas']) ?> </li>
            <?php if ($this->request->getSession()->read('Auth.User.Perfile_id') != 5) {?>
            <li><?= $this->Html->link(__('Gestionar Convocatorias'), ['controller' => 'Convocatorias', 'action' => 'index'],['id' => 'convocatorias']) ?> </li>
            <?php }else{?>
            <li><?= $this->Html->link(__('Gestionar Convocatorias'), ['controller' => 'Convocatorias', 'action' => 'listar'],['id' => 'convocatorias']) ?> </li>
            <?php } ?>
            <li><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'listar'],['id' => 'solicitudes']) ?> </li>           
            <li><?= $this->Html->link(__('Asignar Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'edit'],['id' => 'gestionarsolicitudes']) ?> </li>
            <li><?= $this->Html->link(__('Mis Evaluaciones'), ['controller' => 'Solicitudes', 'action' => 'index'],['id' => 'evaluaciones']) ?> </li>

        </ul>

        <ul class="nav navbar-nav" style="float: right">
                <?php
                        if($this->request->getSession()->read('Auth')) {
                            ?>
                           <li><a href="/usuarios/edit/<?= $this->request->getSession()->read('Auth.User.id')?>"><?= $this->request->getSession()->read('Auth.User.Nombre'); ?> <?php if($this->request->getSession()->read('Auth.User.Perfile_id')==1) echo "/ Administrador"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==2) echo "/ Adminstrador Empresa"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==3) echo "/ Técnico Evaluador"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==4) echo "/ Observador"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==5) echo "/ Solicitante";?></a></li>
                <li>
                           <?php
                           // user is logged in, show logout..user menu etc
                           echo "<li>".$this->Html->link('Cerrar Sesión', array('controller' => 'Usuarios', 'action' => 'logout'))."</li>"; 
                           
                        } else {
                           // the user is not logged in
                           echo $this->Html->link('Iniciar Sesión', array('controller' => 'Usuarios', 'action' => 'login')); 
                        }
                    ?></li>
        </ul>
    <?php
        }
    ?>
    </div>  
</div>
</div>
    <!--<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
               <div>
               		<?php echo $this->html->image('ingenia.jpg', array('alt' => 'CakePHP', 'height' => 100, 'width' => 100)); ?>
               </div>           
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                
            <!--
             *  PORTILLO:
             *
             *  Utilizamos la variable Auth.user para ver tanto id como nombre como si es administrador. Y redirige al view cuando se clica en el nombre.
             *
            -->
                <!--<li><a href="/usuarios/edit/<?= $this->request->getSession()->read('Auth.User.id')?>"><?= $this->request->getSession()->read('Auth.User.Nombre'); ?> <?php if($this->request->getSession()->read('Auth.User.Perfile_id')==1) echo "/ Admin"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==2) echo "/ Admin Empresa"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==3) echo "/ Usuario Empresa Modificar"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==4) echo "/ Usuario Empresa Lectura"; else if($this->request->getSession()->read('Auth.User.Perfile_id')==5) echo "/ Solicitante";?></a></li>
                <li>
                	<?php
						if($this->request->getSession()->read('Auth')) {
						   // user is logged in, show logout..user menu etc
						   echo $this->Html->link('Cerrar Sesión', array('controller' => 'Usuarios', 'action' => 'logout')); 
						} else {
						   // the user is not logged in
						   echo $this->Html->link('Iniciar Sesión', array('controller' => 'Usuarios', 'action' => 'login')); 
						}
					?>
                </li>             
            </ul>
        </div>
    </nav>-->
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <br>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>