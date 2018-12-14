<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasRequisito[]|\Cake\Collection\CollectionInterface $solicitudHasRequisitos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Requisito'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasRequisitos index large-9 medium-8 columns content">
    <h3><?= __('Solicitud Has Requisitos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitude_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('requisito_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evidencia_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudHasRequisitos as $solicitudHasRequisito): ?>
            <tr>
                <td><?= $this->Number->format($solicitudHasRequisito->id) ?></td>
                <td><?= $solicitudHasRequisito->has('solicitude') ? $this->Html->link($solicitudHasRequisito->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasRequisito->solicitude->id]) : '' ?></td>
                <td><?= $solicitudHasRequisito->has('requisito') ? $this->Html->link($solicitudHasRequisito->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $solicitudHasRequisito->requisito->id]) : '' ?></td>
                <td><?= $solicitudHasRequisito->has('evidencia') ? $this->Html->link($solicitudHasRequisito->evidencia->id, ['controller' => 'Evidencias', 'action' => 'view', $solicitudHasRequisito->evidencia->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solicitudHasRequisito->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solicitudHasRequisito->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solicitudHasRequisito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasRequisito->id)]) ?>
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
