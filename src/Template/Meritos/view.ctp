<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Merito $merito
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

<div class="meritos view large-9 medium-8 columns content">
    <h1>Información sobre este merito </h1>
    <table class="table table-striped table-bordered grid2">
        <tr>
            <th scope="row"><?= __('Convocatoria') ?></th>
            <td><?= $merito->has('convocatoria') ? $this->Html->link($merito->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $merito->convocatoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= $merito->has('categoria') ? $this->Html->link($merito->categoria->Descripcion, ['controller' => 'Categorias', 'action' => 'view', $merito->categoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($merito->Descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Puntuacion') ?></th>
            <td><?= h($merito->Puntuacion) ?></td>
        </tr>

    </table>
    <div class="right" id="edit_delete_merito" >
       	<?= $this->Html->link(__('Editar'), ['controller' => 'Meritos', 'action' => 'edit',$merito->id,'id' => $merito->convocatoria->id,'nombre' => $merito->convocatoria->Nombre],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Meritos', 'action' => 'delete', $merito->id,'convocatoria_id' => $merito->convocatoria->id], ['confirm' => __('¿Estas seguro de que desea eliminar este merito?.'),'class' => 'btn btn-danger'])?>  	
    </div>
</div>