<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasMerito[]|\Cake\Collection\CollectionInterface $solicitudHasMeritos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Merito'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Meritos'), ['controller' => 'Meritos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Merito'), ['controller' => 'Meritos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasMeritos index large-9 medium-8 columns content">
    <h3><?= __('Solicitud Has Meritos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitude_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('merito_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evidencia_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudHasMeritos as $solicitudHasMerito): ?>
            <tr>
                <td><?= $this->Number->format($solicitudHasMerito->id) ?></td>
                <td><?= $solicitudHasMerito->has('solicitude') ? $this->Html->link($solicitudHasMerito->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasMerito->solicitude->id]) : '' ?></td>
                <td><?= $solicitudHasMerito->has('merito') ? $this->Html->link($solicitudHasMerito->merito->id, ['controller' => 'Meritos', 'action' => 'view', $solicitudHasMerito->merito->id]) : '' ?></td>
                <td><?= $solicitudHasMerito->has('evidencia') ? $this->Html->link($solicitudHasMerito->evidencia->id, ['controller' => 'Evidencias', 'action' => 'view', $solicitudHasMerito->evidencia->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solicitudHasMerito->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solicitudHasMerito->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solicitudHasMerito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasMerito->id)]) ?>
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
