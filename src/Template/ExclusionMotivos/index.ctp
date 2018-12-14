<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExclusionMotivo[]|\Cake\Collection\CollectionInterface $exclusionMotivos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Exclusion Motivo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Convocatorias'), ['controller' => 'Convocatorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Convocatoria'), ['controller' => 'Convocatorias', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Exclusion Motivos'), ['controller' => 'SolicitudHasExclusionMotivos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Exclusion Motivo'), ['controller' => 'SolicitudHasExclusionMotivos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="exclusionMotivos index large-9 medium-8 columns content">
    <h3><?= __('Exclusion Motivos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('convocatoria_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exclusionMotivos as $exclusionMotivo): ?>
            <tr>
                <td><?= $this->Number->format($exclusionMotivo->id) ?></td>
                <td><?= h($exclusionMotivo->descripcion) ?></td>
                <td><?= $exclusionMotivo->has('convocatoria') ? $this->Html->link($exclusionMotivo->convocatoria->id, ['controller' => 'Convocatorias', 'action' => 'view', $exclusionMotivo->convocatoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $exclusionMotivo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exclusionMotivo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exclusionMotivo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exclusionMotivo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
