<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfile[]|\Cake\Collection\CollectionInterface $perfiles
 */
?>
<style>
	#perfiles_table > tbody > tr:hover{
    background-color: #e4e4e4;
}	
</style>
<?php
if (isset($_GET['success_add'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha añadido el perfil correctamente.
</div>
    <?php
}

if (isset($_GET['success_edit'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      El perfil se guardó correctamente.
</div>
    <?php
}

if (isset($_GET['success_delete'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha eliminado el perfil correctamente.
</div>
    <?php
}

if (isset($_GET['fail_delete'])) {
    ?>
<div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Los datos no se pudieron borrar. Por favor, intentelo de nuevo.
</div>
    <?php
}
?>
<div class="perfiles index large-9 medium-8 columns content">
    <h1><?= __('Perfiles') ?></h1>
        <?= $this->Html->link(__('Añadir Perfil'), ['action' => 'add'],['class' => 'btn btn-primary']) ?>

    <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id="perfiles_table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <!--<th scope="col" class="actions"><?//= __('Acciones') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perfiles as $perfile): ?>
            <tr style="cursor: pointer;" onclick="window.location='/perfiles/view/<?=$perfile->id?>'">
                <td><?= h($perfile->Nombre) ?></td>
                <!--
                <td class="actions">
                    <?//= $this->Html->link(__('Ver'), ['action' => 'view', $perfile->id]) ?>
                    <?//= $this->Html->link(__('Editar'), ['action' => 'edit', $perfile->id]) ?>
                    <?//= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $perfile->id], ['confirm' => __('Estás seguro de que quiere eliminar a # {0}?', $perfile->id)]) ?>
                </td>
                -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php 

	$count = $this->request->getParam('paging.Perfiles.count');

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
        <!--<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>-->
    </div>
    <?php } ?>    
</div>
