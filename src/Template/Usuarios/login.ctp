 <?php
/**
 * -- PORTILLO --
 *
 * Añadida la vista del login en usuarios.
 * 
 * ESTILOS AQUI: https://bootsnipp.com/
 
 <?= $this->Flash->render() ?>
 
 */


if($this->request->getSession()!=null)
{
	header("Location: /usuarios");

}

if (isset($_GET['success_add'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El usuario se guardó correctamente. Ya puede loguearse.
</div>
    <?php
}
?>
<style>

.centrar {
	width: 50%;
	margin: 0 auto;
}
</style>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
     <style>
	.centrar
	{
		margin-top: 50px;
	}
	</style>
    
</head>

<body class="home">
	<?php 

	if (isset($mensaje_error2)) {
		?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?= $mensaje_error2 ?>
		</div>

		<?php
	}

	if (isset($mensaje_error3)) {
		?>
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?= $mensaje_error3 ?>
		</div>

		<?php
	}

	if (isset($_GET['emailsended'])) {
	?>
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Se ha enviado un correo para el restablecimiento de la contraseña
	</div>
	<?php
    } 

	?>

	<div class="centrar">
	<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
		 <div class="panel">
			<fieldset>
				<legend class="text-center">
					<?php echo __('Por favor, introduzca email y contraseña'); ?>
				</legend>
				<div>
					<?= $this->Form->create() ?>
					<?= $this->Form->control('email', array('label' => 'Email:','class' => 'form-control')) ?>
					<?= $this->Form->control('password', array('label' => 'Contraseña:','class' => 'form-control')) ?>
				  	<?= $this->Html->link(__('¿Olvidó su contraseña?'), ['controller' => 'Usuarios', 'action' => 'recoverpassword'],['style' => 'color: #01567D;float:center','escape' => false]) ?>

					<div style="float:right">
						<button type="submit" class="btn btn-primary" style="float: right">Iniciar sesión</button>

					</div>		
				</div>
			</fieldset>
			  	<?= $this->Html->link(__('Crear usuario demandante'), ['controller' => 'Usuarios', 'action' => 'add'],['class' => 'btn btn-primary','style' => 'float:right']) ?>

            <?= $this->Form->end() ?> 
		</div>		
	</div>
	</div>	
</body>