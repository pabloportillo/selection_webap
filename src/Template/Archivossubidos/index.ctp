<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Archivossubido[]|\Cake\Collection\CollectionInterface $archivossubidos
 */
?>
<div class="archivossubidos index large-9 medium-8 columns content">
    <h1><?= __('Archivos subidos') ?></h1>
        <?= $this->Html->link(__('Subir archivo'), ['action' => 'add'],['class' => 'btn btn-primary']) ?>

    <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Archivo','Nombre del archivo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('convocatoria_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($archivossubidos as $archivossubido): ?>
            <tr>
                <td><?= h($archivossubido->Descripcion) ?></td>
                <td><?= h($archivossubido->Archivo) ?></td>
                <td><?= $archivossubido->has('convocatoria') ? $this->Html->link($archivossubido->convocatoria->id, ['controller' => 'Convocatorias', 'action' => 'view', $archivossubido->convocatoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $archivossubido->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $archivossubido->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $archivossubido->id], ['confirm' => __('Are you sure you want to delete # {0}?', $archivossubido->id)]) ?>
                    <?= $this->Html->link('Descargar', ['action' => 'download','archivo' => $archivossubido->Archivo]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
        </ul>
        <!--<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>-->
    </div>
</div>
