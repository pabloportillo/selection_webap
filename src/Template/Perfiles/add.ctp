<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfile $perfile
 */
?>
<script>
	$(document).ready(function() {
		$('#submit').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("Debes elegir al menos una acción");
        return false;
      }

    });

	
});
	
</script>
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
<div class="perfiles form large-9 medium-8 columns content">
    <?= $this->Form->create($perfile) ?>
    <fieldset>
        <legend><?= __('Añadir perfil') ?></legend>
        <?php
            echo $this->Form->control('Nombre',['class' => 'form-control']);
        ?>


				<label for="rol"><b>Acciones</b></label>
				<div id="acciones">
				<table class="table table-striped table-bordered grid2">
				<tr>
					<th>Activo</th>
					<th>Descripción</th>
				</tr>
				<?php

				foreach ($acciones as $accione) {
					
					?>
					<tr>
						<td><input type="checkbox" class="form-control" id="checkbox_<?=$accione->id ?>" name="accione[]" value="<?=$accione->id ?>"></td>
						<label for="checkbox_<?=$accione->id ?>"><td><?= $accione->descripcion ?></td></label>
						</tr>
					<?php
				}

				?>
				</div>
</table>
        
    </fieldset>
   
<input type="submit" id="submit" style="float:right" value="Añadir" class="btn btn-primary"></input>    
<?= $this->Form->end() ?>
</div>