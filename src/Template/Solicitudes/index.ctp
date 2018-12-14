<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<style>
tr.sortable>td {
    cursor: pointer;
}
	
#solicitudes_table > tbody > tr:hover{
    background-color: #e4e4e4;
}	
</style>

<div class="solicitudes index large-9 medium-8 columns content">
    <h1><?= __('Solicitudes') ?></h1> 
    <table style="border-spacing: 0 1em;" class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id="solicitudes_table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('convocatoria_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_solicitante') ?></th>
                <th scope="col">Email</th>              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitude): ?>
		    <tr class="sortable" onclick="window.location='/solicitudes/view/<?=$solicitude->id?>'">
				<td><?= h($solicitude->convocatoria->Nombre) ?></td>
                <td><?= h($solicitude->usuario->Nombre)." ".h($solicitude->usuario->Apellidos)?></td>
                <td><?= h($solicitude->usuario->Email) ?></td>				
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php 

	$count = $this->request->getParam('paging.Solicitudes.count');

	if($count>20)
	{ 
	?>    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} resultado(s) de los {{count}} totales')]) ?></p>
    </div>
    <?php } ?>
</div>
