<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluadorsolicitanterequisito $evaluadorsolicitanterequisito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evaluadorsolicitanterequisito'), ['action' => 'edit', $evaluadorsolicitanterequisito->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evaluadorsolicitanterequisito'), ['action' => 'delete', $evaluadorsolicitanterequisito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluadorsolicitanterequisito->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evaluadorsolicitanterequisitos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluadorsolicitanterequisito'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evaluadorsolicitanterequisitos view large-9 medium-8 columns content">
    <h3><?= h($evaluadorsolicitanterequisito->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('DescripcionEvaluacion') ?></th>
            <td><?= h($evaluadorsolicitanterequisito->DescripcionEvaluacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Requisito') ?></th>
            <td><?= $evaluadorsolicitanterequisito->has('requisito') ? $this->Html->link($evaluadorsolicitanterequisito->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $evaluadorsolicitanterequisito->requisito->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $evaluadorsolicitanterequisito->has('usuario') ? $this->Html->link($evaluadorsolicitanterequisito->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $evaluadorsolicitanterequisito->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evaluadorsolicitanterequisito->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario Id') ?></th>
            <td><?= $this->Number->format($evaluadorsolicitanterequisito->Usuario_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaCreacion') ?></th>
            <td><?= h($evaluadorsolicitanterequisito->FechaCreacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaEvaluacion') ?></th>
            <td><?= h($evaluadorsolicitanterequisito->FechaEvaluacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Validado') ?></th>
            <td><?= $evaluadorsolicitanterequisito->Validado ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reclamacion') ?></th>
            <td><?= $evaluadorsolicitanterequisito->Reclamacion ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
