<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluadorsolicitanterequisito[]|\Cake\Collection\CollectionInterface $evaluadorsolicitanterequisitos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evaluadorsolicitanterequisito'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluadorsolicitanterequisitos index large-9 medium-8 columns content">
    <h3><?= __('Evaluadorsolicitanterequisitos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DescripcionEvaluacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Validado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaCreacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaEvaluacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Reclamacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Usuario_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Requisito_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitante_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluadorsolicitanterequisitos as $evaluadorsolicitanterequisito): ?>
            <tr>
                <td><?= $this->Number->format($evaluadorsolicitanterequisito->id) ?></td>
                <td><?= h($evaluadorsolicitanterequisito->DescripcionEvaluacion) ?></td>
                <td><?= h($evaluadorsolicitanterequisito->Validado) ?></td>
                <td><?= h($evaluadorsolicitanterequisito->FechaCreacion) ?></td>
                <td><?= h($evaluadorsolicitanterequisito->FechaEvaluacion) ?></td>
                <td><?= h($evaluadorsolicitanterequisito->Reclamacion) ?></td>
                <td><?= $this->Number->format($evaluadorsolicitanterequisito->Usuario_id) ?></td>
                <td><?= $evaluadorsolicitanterequisito->has('requisito') ? $this->Html->link($evaluadorsolicitanterequisito->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $evaluadorsolicitanterequisito->requisito->id]) : '' ?></td>
                <td><?= $evaluadorsolicitanterequisito->has('usuario') ? $this->Html->link($evaluadorsolicitanterequisito->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $evaluadorsolicitanterequisito->usuario->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evaluadorsolicitanterequisito->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evaluadorsolicitanterequisito->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evaluadorsolicitanterequisito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluadorsolicitanterequisito->id)]) ?>
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
