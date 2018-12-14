<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Merito $merito
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
<div class="meritos form large-9 medium-8 columns content">
    <?= $this->Form->create($merito) ?>
    <fieldset>
        <?php $nombre = ($tipo == 1) ? 'Formacion' : 'Experiencia' ?>
        <legend><?= __('Añadir '.$nombre) ?></legend>
        <?php
	/*
			echo $this->Form->control('NombreConvocatoria', ['class' => 'form-control', 'readonly' => true, 'value' => $_GET['nombre'], 'type' => 'text']);	
	*/
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";
            echo $this->Form->control('Descripcion',['class' => 'form-control']);
            echo $this->Form->control('Puntuacion',['class' => 'form-control']);
            echo $this->Form->control('categoria_id', ['options' => $categorias, 'required' => true, 'class' => 'form-control']);
            echo $this->Form->control('convocatoria_id', ['options' => $convocatorias, 'value' => $_GET['id'], 'type' => 'hidden']);	
        ?>
        <div class="input select required" hidden>
           <label for="tipo_merito">Tipo de mérito</label>   
            <select name="tipo_merito" id="tipo_merito" class="form-control" required="required">
                <option value="1" <?php if($tipo == 1){ echo "selected";} ?>>No auto puntuable</option>
                <option value="2" <?php if($tipo == 2){ echo "selected";} ?>>Auto puntuable</option>
            </select>
        </div>    
    </fieldset>   
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>