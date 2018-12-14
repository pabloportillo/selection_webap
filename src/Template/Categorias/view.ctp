<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria $categoria
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
	
	tr.sortable>td {
		cursor: pointer;
	}
	
	#informacion_table > tbody > tr:hover{
    background-color: #e4e4e4;
</style>

<div class="categorias view large-9 medium-8 columns content">
    <h1>Información de esta categoria</h1>
    <table class="table table-striped table-bordered grid2">
        <tr>
            <th scope="row"><?= __('Convocatoria') ?></th>
            <td><?= $categoria->has('convocatoria') ? $this->Html->link($categoria->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $categoria->convocatoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($categoria->Descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Puntuacion Máxima') ?></th>
            <td><?= h($categoria->PuntuacionMax) ?></td>
        </tr>

    </table>
    <div class="right" id="edit_delete_categoria">
        <?= $this->Html->link(__('Editar'), ['controller' => 'Categorias', 'action' => 'edit',$categoria->id,'id' => $categoria->convocatoria->id,'nombre' => $categoria->convocatoria->Nombre],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Categorias', 'action' => 'delete', $categoria->id,'convocatoria_id' => $categoria->convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar esta categoría y todos sus méritos relaccionados?, esta acción no es reversible.'),'class' => 'btn btn-danger'])?>
    </div>
</div>