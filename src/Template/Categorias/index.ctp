<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria[]|\Cake\Collection\CollectionInterface $categorias
 */
?>
<div class="categorias index large-9 medium-8 columns content">
   <h1><?= __('Categorias') ?></h1>
   <?= $this->Html->link(__('Añadir Categorias'), ['action' => 'add'],['class' => 'btn btn-primary']) ?>
    <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>  
                <th scope="col"><?= $this->Paginator->sort('Descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PuntuacionMax', array('label' => 'Puntuacion Máxima')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('convocatoria_id', array('label' => 'Convocatoria')) ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= h($categoria->Descripcion) ?></td>
                <td><?= h($categoria->PuntuacionMax) ?></td>
                <td><?= $categoria->has('convocatoria') ? $this->Html->link($categoria->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $categoria->convocatoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $categoria->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $categoria->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $categoria->id], ['confirm' => __('¿Está seguro de que desea borrar {0}?', $categoria->Descripcion)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<!--    
    <div class="left">
    	<//?= $this->Html->link(__('Añadir Categoria'), ['action' => 'add', 'id_convocatoria' => $categoria->convocatoria->id]) ?> 	
    </div>
-->   
    <br>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('')])//'Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) <?= h($usuario->Activo)?></p>
    </div>
</div>
