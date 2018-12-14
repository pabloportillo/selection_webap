<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasRequisito $solicitudHasRequisito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $solicitudHasRequisito->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasRequisito->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Requisitos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasRequisitos form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitudHasRequisito) ?>
    <fieldset>
        <legend><?= __('Edit Solicitud Has Requisito') ?></legend>
        <?php
            echo $this->Form->control('solicitude_id', ['options' => $solicitudes]);
            echo $this->Form->control('requisito_id', ['options' => $requisitos]);
            echo $this->Form->control('evidencia_id', ['options' => $evidencias]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
