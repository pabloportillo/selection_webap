<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfile $perfile
 */
?>

<style>
th {
    width: 15%;
}

.right {
    float: right;
}
</style>
<div class="perfiles view large-9 medium-8 columns content">
    <h1>Información sobre este perfil</h1>
    <table class="table table-striped table-bordered grid2 vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($perfile->Nombre) ?></td>
        </tr>
    </table>
    <div class="right">
        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $perfile->id],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $perfile->id], ['class' => 'btn btn-danger', 'confirm' => __('Está seguro que quiere borrar {0}?', $perfile->Nombre)]) ?>     
    </div>
</div>
