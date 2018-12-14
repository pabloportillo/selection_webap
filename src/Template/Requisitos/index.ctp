<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito[]|\Cake\Collection\CollectionInterface $requisitos
 
 <p><?= $this->Html->link(__('Añadir Requisito'), ['action' => 'add', 'id' => $requisito->convocatoria->id ]) ?></p>
   
 
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Requisitos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Convocatorias'), ['controller' => 'Convocatorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Empresas'), ['controller' => 'Empresas', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="requisitos index large-9 medium-8 columns content">
   
   <?php
	
	if(isset($_GET['Nombre_Convocatoria']))
	{
		$nombre_convocatoria = " de {$_GET['Nombre_Convocatoria']}";
	}else
	{
		$nombre_convocatoria = "";
	}
	
	?>
      
    <h3><?= __('Requisitos' . $nombre_convocatoria)?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Convocatoria') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requisitos as $requisito): ?>
            <tr>
                <td><?= h($requisito->Descripcion) ?></td>
                <td><?= $requisito->has('convocatoria') ? $this->Html->link($requisito->convocatoria->Nombre, ['controller' => 'Convocatorias', 'action' => 'view', $requisito->convocatoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $requisito->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $requisito->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $requisito->id], ['confirm' => __('Seguro que desea borrar este requisito?', $requisito->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
		<p><?= $this->Html->link(__('Añadir Requisito'), ['action' => 'add', 'id' => $_GET['id_convocatoria']]) ?></p>
   
    </div>     
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
