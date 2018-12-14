<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
*/
?>
<?php
if (isset($fail_edit)) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?= $fail_edit ?>
</div>
    <?php
}
?>

<script>
    $(document).ready(function() { 
    $("#deletefile").click(function() {

        $("#DeclaracionResponsable").remove();
        $("#newarchivo").css('display','block');
        $("#newarchivo").prop('disabled',false);
        $("#newarchivo").prop('required',true);
        $("#deletefile").remove();
      });
    });
    
</script>

<div class="empresas form large-9 medium-8 columns content">
    <?= $this->Form->create($empresa, array('enctype'=>'multipart/form-data')) ?>
    <fieldset>
        <legend><?= __('Editar Empresa') ?></legend>
        <div class="form-group row">
            <div class="col-xs-6">
        <?php
            echo $this->Form->control('CIF', ['class' => 'form-control', 'label' => 'CIF *']);
            ?>
        </div>
        <div class="col-xs-6">
            <?php
            echo $this->Form->control('NombreEmpresa', ['label' => 'Nombre *','class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-4">
            <?php
            echo $this->Form->control('NombreContacto', ['label' => 'Nombre de Contacto *','class' => 'form-control']);
            ?>
        </div>
        <div class="col-xs-4">
            <?php
            echo $this->Form->control('ApellidoContacto', ['label' => 'Apellido de Contacto *','class' => 'form-control']);
            ?>
        </div>
        <div class="col-xs-4">
            <?php
            echo $this->Form->control('TelefonoContacto', ['type' => 'tel', 'label' => 'Telefono de Contacto *','class' => 'form-control']);      
        ?>
    	</div>
	</div>
    <div class="form-group row">
    	<div class="col-xs-4">
			<?php
				echo $this->Form->control('DeclaracionResponsable',['id' => 'DeclaracionResponsable','type' => 'text', 'readonly' => true, 'label' => 'Declaración Responsable *', 'class' => 'form-control']);
	            echo $this->Form->control('newarchivo', ['disabled','style' => 'display:none','id' => 'newarchivo','name' => 'newarchivo','type' => 'file', 'class' => 'form-control', 'label' => false]);
            ?>
            <button type="button" id="deletefile" class="btn btn-danger">Eliminar</button>
    	</div>
	</div>
    </fieldset>
  <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>




<?php
/*

-------------------------------------------------------------------------------------------------
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
            echo $this->Form->control('Archivo',['id' => 'archivo','type' => 'text','class' => 'form-control']);
            echo $this->Form->control('newarchivo', ['disabled','style' => 'display:none','id' => 'newarchivo','name' => 'newarchivo','type' => 'file', 'class' => 'form-control', 'label' => false]);
            ?>
            <button type="button" id="deletefile" class="btn btn-danger">Eliminar</button>
        <input type="hidden" name="convocatoria_id" value="<?= $_GET['id'] ?>">
    </fieldset>
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>

*/
?>
