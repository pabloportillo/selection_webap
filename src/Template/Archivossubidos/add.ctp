<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Archivossubido $archivossubido
 */
?>

<div class="archivossubidos form large-9 medium-8 columns content">
    <?= $this->Form->create($archivossubido, array('enctype'=>'multipart/form-data')) ?>
    <fieldset>
        <legend><?= __('Subir archivo') ?></legend>
        <?php
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";
            echo $this->Form->control('Descripcion',['type' => 'textarea', 'class' => 'form-control']);
            echo $this->Form->control('Archivo',['name' => 'archivo', 'type' => 'file','class' => 'form-control']);
        ?>
        <input type="hidden" name="convocatoria_id" value="<?= $_GET['id'] ?>">
    </fieldset>
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>
