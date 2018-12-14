<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Convocatoria $convocatoria

            <div class="input textarea"><label for="descripcion">Descripcion *</label><textarea name="Descripcion" class="edittextarea form-control" required="required" maxlength="3550" id="descripcion" rows="5"></textarea></div>
 
 */
?>
<script>
    $(document).ready(function() {
		$('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true, 
        language: 'es',
        todayBtn: 'linked',
       weekStart: 1 // day of the week start. 0 for Sunday - 6 for Saturday
     });

    });

</script>
<style>
	select {
	  display: inline-block;
	  width: auto;
	  padding: 6px 12px;
	  font-size: 14px;
	  line-height: 1.42857143;
	  color: #555;
	  background-color: #e6f9d1;
	  background-image: none;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
		   -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
			  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	}	
</style>
<script>
    $(document).ready(function() {
		$('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true, 
        language: 'es',
        todayBtn: 'linked',
       weekStart: 1 // day of the week start. 0 for Sunday - 6 for Saturday
     });

    });

</script>
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

<div class="convocatorias form large-9 medium-8 columns content">
    <?= $this->Form->create($convocatoria) ?>
    <fieldset>
        <legend><?= __('Añadir Convocatoria') ?></legend>
        <!-- <date-util format="dd/MM/YYY"></date-util> -->

        <div class="form-group row">
            <div class="col-xs-12">
        <?php
    
            $this->Form->templates(['dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}']);
            
          echo $this->Form->control('Nombre',['class' => 'form-control','label' => 'Nombre *']);	
            ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-12">
            
            <?php
            echo $this->Form->control('Descripcion', ['type' => 'textarea', 'escape' => false,'class' => 'edittextarea form-control','required' => 'false' ,'label' => 'Descripcion *']);				
            ?>  
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
                <label for="FechaAltaConvocatoria">Fecha Alta Convocatoria *</label>
                <?php echo $this->Form->control('FechaAltaConvocatoria',['class' => 'form-control','label' => false]); ?>

        </div>
        <div class="col-xs-6">
                <label for="FechaAltaReclamacion">Fecha Admitidos *</label>
                <?php echo $this->Form->control('FechaAdmitidos',['class' => 'form-control','label' => false]); ?>
        </div>
    </div>
    <div class="form-group row">
         <div class="col-xs-6">
                <label for="FechaBajaConvocatoria">Fecha Baja Convocatoria *</label>
                <?php echo $this->Form->control('FechaBajaConvocatoria',['class' => 'form-control','label' => false]); ?>

        </div>
        <div class="col-xs-6">
                <label for="FechaAltaReclamacion">Fecha Alta Reclamacion Admitidos*</label>
                <?php echo $this->Form->control('FechaAltaReclamacion',['class' => 'form-control','label' => false]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
                 <label for="FechaEvaluacion">Fecha Evaluacion *</label>
                 <?php echo $this->Form->control('FechaEvaluacion',['class' => 'form-control','label' => false]); ?>

        </div>
        <div class="col-xs-6">
                <label for="FechaBajaReclamacion">Fecha Baja Reclamacion Admitidos *</label>
                <?php echo $this->Form->control('FechaBajaReclamacion',['class' => 'form-control','label' => false]); ?>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-xs-6">
                 <label for="FechaAltaReclamacionEvaluacion">Fecha Alta Reclamación Evaluacion *</label>
                 <?php echo $this->Form->control('FechaAltaReclamacionEvaluacion',['class' => 'form-control','label' => false]); ?>

        </div>
        <div class="col-xs-6">
                <label for="FechaBajaReclamacionEvaluacion">Fecha Baja Reclamacion Evaluacion *</label>
                <?php echo $this->Form->control('FechaBajaReclamacionEvaluacion',['class' => 'form-control','label' => false]); ?>

        </div>
    </div>    
    <div class="form-group row">
        <div class="col-xs-12">
            <br>
            <b>Visible</b>     
   			<?php
				echo $this->Form->control('Visible',['templates' => ['inputContainer' => '{{content}}'], 'label' => false]);
			?>
   		</div>
	</div>
    </fieldset>
      <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
    <?= $this->Form->end() ?>
</div>