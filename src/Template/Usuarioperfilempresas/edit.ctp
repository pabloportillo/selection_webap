<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuarioperfilempresa $usuarioperfilempresa
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usuarioperfilempresa->Usuario_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioperfilempresa->Usuario_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Usuarioperfilempresas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="usuarioperfilempresas form large-9 medium-8 columns content">
    <?= $this->Form->create($usuarioperfilempresa) ?>
    <fieldset>
        <legend><?= __('Edit Usuarioperfilempresa') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
