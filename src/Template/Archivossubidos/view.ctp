<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Archivossubido $archivossubido
 */
?>
<style>

	th {
		width: 15%;
	}

	.right {
    float:right;
	}
	
	.ajustado {
    	width: 15%;;
	}
	
</style>

 <div class="archivossubidos view large-9 medium-8 columns content">
    <h1>Información sobre este archivo</h1>
    <table class="table table-striped table-bordered grid2 vertical-table">
        <tr>
            <th scope="row"><?= __('Convocatoria') ?></th>
            <td><?= $archivossubido->has('convocatoria') ? $this->Html->link($archivossubido->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $archivossubido->convocatoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($archivossubido->Descripcion) ?></td>
        </tr>
    </table>
    <div class="right" id="edit_delete_archivossubidos">
		<?= $this->Html->link(__('Editar'), ['controller' => 'Archivossubidos', 'action' => 'edit', $archivossubido->id, 'id' => $archivossubido->convocatoria->id,'nombre' => $archivossubido->convocatoria->Nombre],['class' => 'btn btn-primary']) ?>

		<?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Archivossubidos', 'action' => 'delete', $archivossubido->id,'convocatoria_id' => $archivossubido->convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar este archivo?'),'class' => 'btn btn-danger']) ?>
	</div>	
	<div class="right">
		<?= $this->Form->postLink('Descargar', ['controller' => 'Archivossubidos','action' => 'download','archivo' => $archivossubido->Archivo],['class' => 'btn btn-primary']) ?>		
	</div>    
</div>
