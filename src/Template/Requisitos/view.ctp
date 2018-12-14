<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito $requisito
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

<div class="requisitos view large-9 medium-8 columns content">
     <h1>Información sobre este requisito</h1>
    <table class="table table-striped table-bordered grid2">
        <tr>
            <th scope="row"><?= __('Convocatoria') ?></th>
            <td><?= $requisito->has('convocatoria') ? $this->Html->link($requisito->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $requisito->convocatoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($requisito->Descripcion) ?></td>
        </tr>
    </table>
	<div class="right" id="edit_delete_requisitos">

		<?= $this->Html->link(__('Editar'), ['controller' => 'Requisitos', 'action' => 'edit',$requisito->id,'id' => $requisito->convocatoria->id,'nombre' => $requisito->convocatoria->Nombre],['class' => 'btn btn-primary']) ?>

		<?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Requisitos', 'action' => 'delete', $requisito->id,'convocatoria_id' => $requisito->convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar este requisito?.'),'class' => 'btn btn-danger']) ?>		
	</div>   
</div>	