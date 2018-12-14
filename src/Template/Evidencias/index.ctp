<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evidencia[]|\Cake\Collection\CollectionInterface $evidencias
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evidencia'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Meritos'), ['controller' => 'SolicitudHasMeritos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Merito'), ['controller' => 'SolicitudHasMeritos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Requisitos'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Requisito'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evidencias index large-9 medium-8 columns content">
    <h3><?= __('Evidencias') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcionEvidencia') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evidencias as $evidencia): ?>
            <tr>
                <td><?= $this->Number->format($evidencia->id) ?></td>
                <td><?= h($evidencia->descripcionEvidencia) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evidencia->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evidencia->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evidencia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evidencia->id)]) ?>
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
