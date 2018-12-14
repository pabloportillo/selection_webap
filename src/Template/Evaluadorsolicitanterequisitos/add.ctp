<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluadorsolicitanterequisito $evaluadorsolicitanterequisito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Evaluadorsolicitanterequisitos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluadorsolicitanterequisitos form large-9 medium-8 columns content">
    <?= $this->Form->create($evaluadorsolicitanterequisito) ?>
    <fieldset>
        <legend><?= __('Add Evaluadorsolicitanterequisito') ?></legend>
        <?php
            echo $this->Form->control('DescripcionEvaluacion');
            echo $this->Form->control('Validado');
            echo $this->Form->control('FechaCreacion');
            echo $this->Form->control('FechaEvaluacion', ['empty' => true]);
            echo $this->Form->control('Reclamacion');
            echo $this->Form->control('Usuario_id');
            echo $this->Form->control('Requisito_id', ['options' => $requisitos]);
            echo $this->Form->control('solicitante_id', ['options' => $usuarios, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
