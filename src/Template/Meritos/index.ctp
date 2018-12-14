<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Merito[]|\Cake\Collection\CollectionInterface $meritos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Solicitud'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="meritos index large-9 medium-8 columns content">
   
   <?php
	
	if(isset($_GET['Nombre_Solicitud']))
	{
		$nombre_solicitud = " de {$_GET['Nombre_Solicitud']}";
	}else
	{
		$nombre_solicitud = "";
	}
	
	?>   
   
    <h3><?= __('Meritos' . $nombre_solicitud) ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Puntuacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitude_id', array('label' => 'Solicitud')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('categoria_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meritos as $merito): ?>
            <tr>
                <td><?= h($merito->Descripcion) ?></td>
                <td><?= h($merito->Puntuacion) ?></td>
                <td><?= $merito->has('solicitude') ? $this->Html->link($merito->solicitude->Nombre, ['controller' => 'Solicitudes', 'action' => 'view', $merito->solicitude->id]) : '' ?></td>
                <td><?= $merito->has('categoria') ? $this->Html->link($merito->categoria->Descripcion, ['controller' => 'Categorias', 'action' => 'view', $merito->categoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $merito->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $merito->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $merito->id], ['confirm' => __('¿Está seguro de que desea borrar {0}?', $merito->Descripcion)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
    		<!--
    		  *
    		  *
    		  *  PORTILLO
    		  *
    		  *  Le pasamos por un lado, solo la variable $merito->solicitude->id, para que trabaje el controlador añadir
    		  *  que es lo que recibe como paramentro para realizar la query y sacar las categorias asociadas a la 
    		  *  solicitud asociada a su vez con meritos.
    		  *
    		  *  Por otro lado le pasamos el 'id_solicitud' con la variable de solicitud para vincular directamente el  * *  merito con la solicitud.
    		  
    		 -->
			<p><?= $this->Html->link(__('Añadir Merito'), ['action' => 'add', $merito->solicitude->id, 'id_solicitud' => $merito->solicitude->id]) ?></p>
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
