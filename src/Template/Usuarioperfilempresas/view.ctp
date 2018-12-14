<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuarioperfilempresa $usuarioperfilempresa
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuarioperfilempresa'), ['action' => 'edit', $usuarioperfilempresa->Usuario_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuarioperfilempresa'), ['action' => 'delete', $usuarioperfilempresa->Usuario_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioperfilempresa->Usuario_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuarioperfilempresas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuarioperfilempresa'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarioperfilempresas view large-9 medium-8 columns content">
    <h3><?= h($usuarioperfilempresa->Usuario_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario Id') ?></th>
            <td><?= $this->Number->format($usuarioperfilempresa->Usuario_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Perfile Id') ?></th>
            <td><?= $this->Number->format($usuarioperfilempresa->Perfile_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa Id') ?></th>
            <td><?= $this->Number->format($usuarioperfilempresa->Empresa_id) ?></td>
        </tr>
    </table>
</div>
