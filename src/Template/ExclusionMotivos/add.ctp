<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExclusionMotivo $exclusionMotivo
 */
?>
<div class="exclusionmotivos form large-9 medium-8 columns content">
    <?= $this->Form->create($exclusionMotivo) ?>
    <fieldset>
        <legend><?= __('Añadir Motivo de Exclusión') ?></legend>
        <?php
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";
            echo $this->Form->control('descripcion',['class' => 'form-control', 'required' => true]);
            echo $this->Form->control('convocatoria_id', ['options' => $convocatorias, 'type' => 'hidden', 'value' => $_GET['id']]);
        ?>
    </fieldset>
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>