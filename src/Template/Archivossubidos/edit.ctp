<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Archivossubido $archivossubido
 */
?>
<script>
    $(document).ready(function() { 
    $("#deletefile").click(function() {

        $("#archivo").remove();
        $("#newarchivo").css('display','block');
        $("#newarchivo").prop('disabled',false);
        $("#newarchivo").prop('required',true);
        $("#deletefile").remove();
      });
    });
    
    </script>
<div class="archivossubidos form large-9 medium-8 columns content">
    <?= $this->Form->create($archivossubido, array('enctype'=>'multipart/form-data')) ?>
    <fieldset>
        <legend><?= __('Editar Archivo Subido') ?></legend>
        <?php
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";

            echo $this->Form->control('Descripcion',['type' => 'textarea', 'class' => 'form-control']);
            echo $this->Form->control('Archivo',['id' => 'archivo','type' => 'text', 'readonly' => true, 'label' => 'Archivo *','class' => 'form-control']);
            echo $this->Form->control('newarchivo', ['disabled','style' => 'display:none','id' => 'newarchivo','name' => 'newarchivo','type' => 'file', 'class' => 'form-control', 'label' => false]);
            ?>
            <button type="button" id="deletefile" class="btn btn-danger">Eliminar</button>
        <input type="hidden" name="convocatoria_id" value="<?= $_GET['id'] ?>">
    </fieldset>
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>
