<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasExclusionMotivo $solicitudHasExclusionMotivo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $solicitudHasExclusionMotivo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasExclusionMotivo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Exclusion Motivos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exclusion Motivos'), ['controller' => 'ExclusionMotivos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exclusion Motivo'), ['controller' => 'ExclusionMotivos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasExclusionMotivos form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitudHasExclusionMotivo) ?>
    <fieldset>
        <legend><?= __('Edit Solicitud Has Exclusion Motivo') ?></legend>
        <?php
            echo $this->Form->control('exclusion_motivo_id', ['options' => $exclusionMotivos]);
            echo $this->Form->control('solicitude_id', ['options' => $solicitudes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
