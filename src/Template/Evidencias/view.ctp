<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evidencia $evidencia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evidencia'), ['action' => 'edit', $evidencia->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evidencia'), ['action' => 'delete', $evidencia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evidencia->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evidencias'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evidencia'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitud Has Meritos'), ['controller' => 'SolicitudHasMeritos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitud Has Merito'), ['controller' => 'SolicitudHasMeritos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitud Has Requisitos'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitud Has Requisito'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evidencias view large-9 medium-8 columns content">
    <h3><?= h($evidencia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('DescripcionEvidencia') ?></th>
            <td><?= h($evidencia->descripcionEvidencia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evidencia->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Solicitud Has Meritos') ?></h4>
        <?php if (!empty($evidencia->solicitud_has_meritos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Solicitude Id') ?></th>
                <th scope="col"><?= __('Merito Id') ?></th>
                <th scope="col"><?= __('Evidencia Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($evidencia->solicitud_has_meritos as $solicitudHasMeritos): ?>
            <tr>
                <td><?= h($solicitudHasMeritos->id) ?></td>
                <td><?= h($solicitudHasMeritos->solicitude_id) ?></td>
                <td><?= h($solicitudHasMeritos->merito_id) ?></td>
                <td><?= h($solicitudHasMeritos->evidencia_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SolicitudHasMeritos', 'action' => 'view', $solicitudHasMeritos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SolicitudHasMeritos', 'action' => 'edit', $solicitudHasMeritos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SolicitudHasMeritos', 'action' => 'delete', $solicitudHasMeritos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasMeritos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Solicitud Has Requisitos') ?></h4>
        <?php if (!empty($evidencia->solicitud_has_requisitos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Solicitude Id') ?></th>
                <th scope="col"><?= __('Requisito Id') ?></th>
                <th scope="col"><?= __('Evidencia Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($evidencia->solicitud_has_requisitos as $solicitudHasRequisitos): ?>
            <tr>
                <td><?= h($solicitudHasRequisitos->id) ?></td>
                <td><?= h($solicitudHasRequisitos->solicitude_id) ?></td>
                <td><?= h($solicitudHasRequisitos->requisito_id) ?></td>
                <td><?= h($solicitudHasRequisitos->evidencia_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'view', $solicitudHasRequisitos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'edit', $solicitudHasRequisitos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SolicitudHasRequisitos', 'action' => 'delete', $solicitudHasRequisitos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitudHasRequisitos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
