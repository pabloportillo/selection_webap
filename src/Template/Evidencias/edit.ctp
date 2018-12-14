<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evidencia $evidencia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evidencia->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evidencia->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Evidencias'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Meritos'), ['controller' => 'SolicitudHasMeritos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Merito'), ['controller' => 'SolicitudHasMeritos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitud Has Requisitos'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitud Has Requisito'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evidencias form large-9 medium-8 columns content">
    <?= $this->Form->create($evidencia) ?>
    <fieldset>
        <legend><?= __('Edit Evidencia') ?></legend>
        <?php
            echo $this->Form->control('descripcionEvidencia');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
