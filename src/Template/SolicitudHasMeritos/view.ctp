<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasMerito $solicitudHasMerito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Solicitud Has Merito'), ['action' => 'edit', $solicitudHasMerito->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Solicitud Has Merito'), ['action' => 'delete', $solicitudHasMerito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasMerito->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Solicitud Has Meritos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitud Has Merito'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Meritos'), ['controller' => 'Meritos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Merito'), ['controller' => 'Meritos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solicitudHasMeritos view large-9 medium-8 columns content">
    <h3><?= h($solicitudHasMerito->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Solicitude') ?></th>
            <td><?= $solicitudHasMerito->has('solicitude') ? $this->Html->link($solicitudHasMerito->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $solicitudHasMerito->solicitude->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merito') ?></th>
            <td><?= $solicitudHasMerito->has('merito') ? $this->Html->link($solicitudHasMerito->merito->id, ['controller' => 'Meritos', 'action' => 'view', $solicitudHasMerito->merito->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evidencia') ?></th>
            <td><?= $solicitudHasMerito->has('evidencia') ? $this->Html->link($solicitudHasMerito->evidencia->id, ['controller' => 'Evidencias', 'action' => 'view', $solicitudHasMerito->evidencia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($solicitudHasMerito->id) ?></td>
        </tr>
    </table>
</div>
