<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa[]|\Cake\Collection\CollectionInterface $empresas
 
 
        <li class="heading"><?= __('Acciones') ?></li>
 */
?>
<style>
	#empresas_table > tbody > tr:hover{
    background-color: #e4e4e4;
}	
</style>
<?php
if (isset($_GET['success_add'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha añadido la empresa correctamente.
</div>
    <?php
}

if (isset($_GET['success_edit'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      La empresa se guardó correctamente.
</div>
    <?php
}

if (isset($_GET['success_delete'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha eliminado la empresa correctamente.
</div>
    <?php
}

if (isset($_GET['fail_delete'])) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Los datos no se pudieron borrar. Por favor, intentelo de nuevo.
</div>
    <?php
}
?>
<div class="empresas index large-9 medium-8 columns content">
    <h1><?= __('Empresas') ?></h1>
    <p><?= $this->Html->link(__('Añadir Empresa'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?></p>

    <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id="empresas_table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('CIF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NombreEmpresa', array('label' => 'Nombre')) ?></th>
                <!--<th scope="col" class="actions"><?//= __('Acciones') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
            <tr style="cursor: pointer;" onclick="window.location='/empresas/view/<?=$empresa->id?>'">
                <td><?= h($empresa->CIF) ?></td>
                <td><?= h($empresa->NombreEmpresa) ?></td>
                <!--           
                <td class="actions">
                    <?//= $this->Html->link(__('Ver'), ['action' => 'view', $empresa->id]) ?>
                    <?//= $this->Html->link(__('Editar'), ['action' => 'edit', $empresa->id]) ?>
                    <?//= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $empresa->id], ['confirm' => __('¿Está seguro que quiere eliminar {0}?', $empresa->NombreEmpresa)]) ?>
                </td>
                -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
    </div>
	<?php 

	$count = $this->request->getParam('paging.Empresas.count');

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
        <p><?= $this->Paginator->counter(['format' => __('')])//'Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <?php } ?>      
</div>