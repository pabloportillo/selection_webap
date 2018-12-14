<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasRequisito $solicitudHasRequisito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Solicitud Has Requisito'), ['action' => 'edit', $solicitudHasRequisito->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Solicitud Has Requisito'), ['action' => 'delete', $solicitudHasRequisito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasRequisito->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Solicitud Has Requisitos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitud Has Requisito'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solicitudHasRequisitos view large-9 medium-8 columns content">
    <h3><?= h($solicitudHasRequisito->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Solicitude') ?></th>
            <td><?= $solicitudHasRequisito->has('solicitude') ? $this->Html->link($solicitudHasRequisito->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasRequisito->solicitude->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Requisito') ?></th>
            <td><?= $solicitudHasRequisito->has('requisito') ? $this->Html->link($solicitudHasRequisito->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $solicitudHasRequisito->requisito->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evidencia') ?></th>
            <td><?= $solicitudHasRequisito->has('evidencia') ? $this->Html->link($solicitudHasRequisito->evidencia->id, ['controller' => 'Evidencias', 'action' => 'view', $solicitudHasRequisito->evidencia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($solicitudHasRequisito->id) ?></td>
        </tr>
    </table>
</div>
