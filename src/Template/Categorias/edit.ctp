<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria $categoria
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
<div class="categorias form large-9 medium-8 columns content">
    <?= $this->Form->create($categoria) ?>
    <fieldset>
        <legend><?= __('Editar Categoria') ?></legend>
        <?php
	/*
            echo $this->Form->control('NombreConvocatoria', ['class' => 'form-control', 'readonly' => true, 'value' => $_GET['nombre'], 'type' => 'text']);	
	*/
			echo "<h2><b>&nbsp &nbsp &nbsp".$_GET['nombre']."</h2></b><br>";
            echo $this->Form->control('Descripcion',['class' => 'form-control']);
            echo $this->Form->control('PuntuacionMax',['class' => 'form-control']);
        ?>
        <input type="hidden" name="convocatoria_id" value="<?= $_GET['id'] ?>">
    </fieldset>
    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>
