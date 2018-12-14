<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuarioperfilempresa[]|\Cake\Collection\CollectionInterface $usuarioperfilempresas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuarioperfilempresa'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarioperfilempresas index large-9 medium-8 columns content">
    <h3><?= __('Usuarioperfilempresas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Usuario_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Perfile_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Empresa_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioperfilempresas as $usuarioperfilempresa): ?>
            <tr>
                <td><?= $this->Number->format($usuarioperfilempresa->Usuario_id) ?></td>
                <td><?= $this->Number->format($usuarioperfilempresa->Perfile_id) ?></td>
                <td><?= $this->Number->format($usuarioperfilempresa->Empresa_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usuarioperfilempresa->Usuario_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usuarioperfilempresa->Usuario_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usuarioperfilempresa->Usuario_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioperfilempresa->Usuario_id)]) ?>
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
