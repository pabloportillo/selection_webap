<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario 
 
 
             <td><img src="data:image/jpeg;base64,"<?= base64_encode($usuario->Foto)?> alt=""></td> <!--si no prueba con el stream get content -->
			 
			 
		     <td><img src="data:image/jpeg;base64,"<?= stream_get_contents($usuario->Foto)?> alt=""></td> 	
			 
			 
			  
             <td><img src="data:image/jpeg;base64,"<?= base64_encode(stream_get_contents($usuario->Foto))?> alt=""></td> <!--si no prueba con el stream get content -->
 */
?>
<style>
  
th {
    width: 15%;
}

.right {
    float: right;
}

img.foto{
  width: 300px; height: 300px;
}    
    
</style>

<div class="usuarios view large-9 medium-8 columns content">
    <h1>Información sobre este usuario</h1>
    <table class="vertical-table table table-striped table-bordered grid2">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($usuario->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($usuario->Apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dni') ?></th>
            <td><?= h($usuario->Dni) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Direccion') ?></th>
            <td><?= h($usuario->Direccion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Localidad') ?></th>
			<td><?= h($usuario->Localidad) ?></td>              
        </tr>
        <tr>
            <th scope="row"><?= __('Código Postal') ?></th>
			<td><?= h($usuario->Cp) ?></td>              
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($usuario->Email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono') ?></th>
            <td><?= $this->Number->format($usuario->Telefono , ['locale' => 'fr_FR']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Perfil') ?></th>
			<td><?= h($usuario->perfile->Nombre) ?></td>              
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa') ?></th>
            <td><?= $usuario->has('empresa') ? $this->Html->link($usuario->empresa->NombreEmpresa, ['controller' => 'Empresas', 'action' => 'view', $usuario->empresa->id]) : '' ?></td>
        </tr>
        <?php if($usuario->Perfile_id == 5) {?>
        <tr>
            <th scope="row"><?= __('Foto') ?></th>
            <td>
                <?php 
                $contenido = stream_get_contents($usuario->Foto);

                $size = strlen($contenido);
                if($size != 0) { 
                
                ?>
                <img class="foto" src="data:image/jpg;base64,<?= $contenido ?>">
                <?php } ?>
            </td> 
        </tr>
        <?php }?>
        <tr>
            <th scope="row"><?= __('Activo') ?></th>
            <td><?= $usuario->Activo ? __('Si') : __('No'); ?></td>
        </tr> 
    </table>
    <div class="right">
    	<div>
			<?= $this->Html->link(__('Editar '), ['action' => 'edit', $usuario->id],['class' => 'btn btn-primary']) ?>
              
   			<?php  
            if(($convocatoria == null) && ($solicitud == null)) {
                echo  $this->Form->postLink(
					__('Borrar '),
					['action' => 'delete', $usuario->id],
					['class' => 'btn btn-danger', 'confirm' => __('¿Está seguro de que desea eliminar este usuario ?')]
				); 
            }else {
			?>
            <button type="submit"  onclick="DeleteUser(<?=$usuario->id?>)" class="btn btn-danger" style="float: right">Borrar</button>
            <?php } ?>

    	</div>
	</div>
<script>
    function DeleteUser(id) {

        alert("Este usuario tiene creadas convocatorias y/o tiene solicitudes asignadas para evaluar. Desactive este usuario si pretende desahcerse de él.")

	}
</script>	 
</div>