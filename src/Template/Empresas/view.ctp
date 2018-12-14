<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
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
<div class="empresas view large-9 medium-8 columns content">
    <h1>Información sobre esta empresa</h1>
    <table class="table table-striped table-bordered grid2 vertical-table">      
        <tr>
            <th scope="row"><?= __('CIF') ?></th>
            <td><?= h($empresa->CIF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($empresa->NombreEmpresa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre de Contacto') ?></th>
            <td><?= h($empresa->NombreContacto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido de Contacto') ?></th>
            <td><?= h($empresa->ApellidoContacto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teléfono') ?></th>
            <td><?= $this->Number->format($empresa->TelefonoContacto , ['locale' => 'fr_FR']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Declaración Responsable') ?></th>
            <td><?=  h($empresa->DeclaracionResponsable) ?></td>
        </tr>
    </table>
    <div class="right">
		<?= $this->Form->postLink('Descargar Declaración Responsable', ['controller' => 'Archivossubidos','action' => 'download','archivo' => $empresa->DeclaracionResponsable],['class' => 'btn btn-primary']) ?>	
       	<?= $this->Html->link(__('Editar'), ['action' => 'edit', $empresa->id],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $empresa->id], ['class' => 'btn btn-danger', 'confirm' => __('Está seguro que quiere borrar {0}?', $empresa->NombreEmpresa)]) ?>  	
    </div>
</div>  