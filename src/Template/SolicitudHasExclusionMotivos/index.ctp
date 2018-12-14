<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasExclusionMotivo[]|\Cake\Collection\CollectionInterface $solicitudHasExclusionMotivos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Exclusion Motivo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exclusion Motivos'), ['controller' => 'ExclusionMotivos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exclusion Motivo'), ['controller' => 'ExclusionMotivos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasExclusionMotivos index large-9 medium-8 columns content">
    <h3><?= __('Solicitud Has Exclusion Motivos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exclusion_motivo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitude_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudHasExclusionMotivos as $solicitudHasExclusionMotivo): ?>
            <tr>
                <td><?= $this->Number->format($solicitudHasExclusionMotivo->id) ?></td>
                <td><?= $solicitudHasExclusionMotivo->has('exclusion_motivo') ? $this->Html->link($solicitudHasExclusionMotivo->exclusion_motivo->id, ['controller' => 'ExclusionMotivos', 'action' => 'view', $solicitudHasExclusionMotivo->exclusion_motivo->id]) : '' ?></td>
                <td><?= $solicitudHasExclusionMotivo->has('solicitude') ? $this->Html->link($solicitudHasExclusionMotivo->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasExclusionMotivo->solicitude->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solicitudHasExclusionMotivo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solicitudHasExclusionMotivo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solicitudHasExclusionMotivo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasExclusionMotivo->id)]) ?>
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