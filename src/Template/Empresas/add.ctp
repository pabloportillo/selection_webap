<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
?>
<?php
if (isset($fail_add)) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?= $fail_add ?>
</div>
    <?php
}

?>
<div class="empresas form large-9 medium-8 columns content">
    <?= $this->Form->create($empresa, array('enctype'=>'multipart/form-data')) ?>
    <fieldset>
    <legend><?= __('Añadir Empresa') ?></legend>
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
				echo $this->Form->control('DeclaracionResponsable',['label' => 'Declaración Responsable *', 'name' => 'DeclaracionResponsable',  'required' => true, 'type' => 'file','class' => 'form-control']);
			?>
        </div>
    </div>
    </fieldset>
  <button type="submit" class="btn btn-primary" style="float: right">Añadir empresa</button>
    <?= $this->Form->end() ?>
</div>
<?php /*

-----------------------------------------------------------------------------------------------------------
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


*/ ?>
       

                                           