<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasExclusionMotivo $solicitudHasExclusionMotivo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Solicitud Has Exclusion Motivo'), ['action' => 'edit', $solicitudHasExclusionMotivo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Solicitud Has Exclusion Motivo'), ['action' => 'delete', $solicitudHasExclusionMotivo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasExclusionMotivo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Solicitud Has Exclusion Motivos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitud Has Exclusion Motivo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exclusion Motivos'), ['controller' => 'ExclusionMotivos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exclusion Motivo'), ['controller' => 'ExclusionMotivos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solicitudHasExclusionMotivos view large-9 medium-8 columns content">
    <h3><?= h($solicitudHasExclusionMotivo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exclusion Motivo') ?></th>
            <td><?= $solicitudHasExclusionMotivo->has('exclusion_motivo') ? $this->Html->link($solicitudHasExclusionMotivo->exclusion_motivo->id, ['controller' => 'ExclusionMotivos', 'action' => 'view', $solicitudHasExclusionMotivo->exclusion_motivo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Solicitude') ?></th>
            <td><?= $solicitudHasExclusionMotivo->has('solicitude') ? $this->Html->link($solicitudHasExclusionMotivo->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasExclusionMotivo->solicitude->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($solicitudHasExclusionMotivo->id) ?></td>
        </tr>
    </table>
</div>
