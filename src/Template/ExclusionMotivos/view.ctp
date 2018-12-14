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

<div class="exclusionmotivos view large-9 medium-8 columns content">
     <h1>Información sobre este motivo de exclusión</h1>
    <table class="table table-striped table-bordered grid2">
        <tr>
            <th scope="row"><?= __('Convocatoria') ?></th>
            <td><?= $exclusionMotivo->has('convocatoria') ? $this->Html->link($exclusionMotivo->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $exclusionMotivo->convocatoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($exclusionMotivo->descripcion) ?></td>
        </tr>
    </table>
	<div class="right" id="edit_delete_motivos">

		<?= $this->Html->link(__('Editar'), ['controller' => 'ExclusionMotivos', 'action' => 'edit',$exclusionMotivo->id,'id' => $exclusionMotivo->convocatoria->id,'nombre' => $exclusionMotivo->convocatoria->Nombre],['class' => 'btn btn-primary']) ?>

		<?= $this->Form->postLink(__('Eliminar'), ['controller' => 'ExclusionMotivos', 'action' => 'delete', $exclusionMotivo->id, 'convocatoria_id' => $exclusionMotivo->convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar este motivo de exclusión?.'),'class' => 'btn btn-danger']) ?>			
	</div>   
</div>	