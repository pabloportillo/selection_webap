<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolicitudHasMerito $solicitudHasMerito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Meritos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Meritos'), ['controller' => 'Meritos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Merito'), ['controller' => 'Meritos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evidencias'), ['controller' => 'Evidencias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evidencia'), ['controller' => 'Evidencias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudHasMeritos form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitudHasMerito) ?>
    <fieldset>
        <legend><?= __('Add Solicitud Has Merito') ?></legend>
        <?php
            echo $this->Form->control('solicitude_id', ['options' => $solicitudes]);
            echo $this->Form->control('merito_id', ['options' => $meritos]);
            echo $this->Form->control('evidencia_id', ['options' => $evidencias]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
