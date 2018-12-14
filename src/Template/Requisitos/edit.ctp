<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito $requisito
 */
?>
<div class="requisitos form large-9 medium-8 columns content">
    <?= $this->Form->create($requisito) ?>
    <fieldset>
        <legend><?= __('Editar Requisito') ?></legend>
        <?php
	/*
            echo $this->Form->control('NombreConvocatoria', ['class' => 'form-control', 'readonly' => true, 'value' => $_GET['nombre'], 'type' => 'text']);
	*/
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";
            echo $this->Form->control('Descripcion',['class' => 'form-control']);
            echo $this->Form->control('motivo_exclusion',['class' => 'form-control']);
            echo $this->Form->control('convocatoria_id', ['options' => $convocatorias, 'type' => 'hidden', 'value' => $_GET['id']]);
        ?>
    </fieldset>
       <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>