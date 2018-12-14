<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<style>
tr.sortable>td {
    cursor: pointer;
}
	
#solicitudes_table > tbody > tr:hover{
    background-color: #e4e4e4;
}	
</style>
<div class="solicitudes index large-9 medium-8 columns content">
    <h1><?= __('Solicitudes') ?></h1>
    
	<div class="panel-group" id="accordion" role="tablist">
			<div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-filter" ></i> Filtros <i class="fa fa-chevron-down pull-right"></i></a></h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body" id="divFiltro">   
	<form>
		<div class="form-group row">
			<div class="col-xs-6">
				<label for="termino">Término a buscar</label>
				<input type="text" class="form-control" name="termino" value="<?php if(isset($_GET['termino'])) echo $_GET['termino'];?>">
				</div>
			<div class="col-xs-6">    
				<label for="estado">Estado</label>
				<select name="estado" class="form-control">
					<option value="Todos"<?php if(isset($_GET['estado']) && $_GET['estado'] =='Todos') echo 'selected="selected" ';?>>Todas las solicitudes</option>
					<option value="Asignadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='Asignadas') echo 'selected="selected" ';?>>Solicitudes asignadas</option>
					<option value="No_Asignadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='No_Asignadas') echo 'selected="selected" ';?>>Solicitudes sin asignar</option>
					<option value="Todas_Reclamaciones"<?php if(isset($_GET['estado']) && $_GET['estado'] =='Todas_Reclamaciones') echo 'selected="selected" ';?>>Todas las reclamaciones</option>
					<option value="Reclamaciones_Asignadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='Reclamaciones_Asignadas') echo 'selected="selected" ';?>>Reclamaciones asignadas</option>
					<option value="Reclamaciones_No_Asignadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='Reclamaciones_No_Asignadas') echo 'selected="selected" ';?>>Reclamaciones sin asignar</option>					
				</select>				
			</div>			
		</div>
					
	  <button style="float: right" type="submit" class="btn btn-default">Buscar</button>
	</form>               
	 </div>
			</div>
		</div>
	</div> 
        
    <table style="border-spacing: 0 1em;" class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id="solicitudes_table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('convocatoria_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_solicitante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_evaluador') ?></th>               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitude): ?>
            <?= $this->Form->create($solicitude) ?>
			<tr>
				<td><?= h($solicitude->convocatoria->Nombre) ?></td>   	  	
                <td><?= h($solicitude->usuario->Nombre) ?></td>
                <td>
						<?php
							//$select_id = "select_".$solicitude->convocatoria->id;
							echo $this->Form->control('usuario_evaluador', ['options' => $usuarios, 'empty' => 'Sin asignar','class' => 'form-control', 'type' => 'select', 'id' => 'select_'.$solicitude->id,'templates' => ['inputContainer' => '{{content}}'], 'label' => false]);
						?>
                </td>
            </tr>   
				
           	<script>
			$(document).ready(function()
			{
				
				$("#select_<?=$solicitude->id?>").change(function() 
				{	

						  var evaluadorid = $(this).val();
						  var idsolicitud = "<?= $solicitude->id ?>";
						  var url = "cambiarusuarioevaluador";

						  console.log("evaluador id: "+evaluadorid);
						  console.log("solicitud id: "+idsolicitud);
						  console.log(url);

						  $.ajax({
											 url: url,
											 dataType: "JSON",
											 method: "POST",
											 data: { solicitud_id: idsolicitud, usuario_evaluador: evaluadorid }
										   }).done(function() {

										   });

				});
			});
			</script>
                   
            <?= $this->Form->end() ?>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php 

	$count = $this->request->getParam('paging.Solicitudes.count');

	if($count>20)
	{ 
	?>    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} resultado(s) de los {{count}} totales')]) ?></p>
    </div>
    <?php } ?>
</div>