<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
*/
?>
<style>
    
.pointer {cursor: pointer;}
    
</style>
<div class="solicitudes view large-9 medium-8 columns content">
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
			<div class="col-xs-4">
            <?php
    
                if(isset($_GET['convocatorias'])){
                    $convocatoria_id = $_GET['convocatorias'];
                }else if(isset($id) && $id != null) {
                    $convocatoria_id = $id;
                }else {
                    $convocatoria_id = false;
                }                            
    
                echo $this->Form->control('convocatorias', ['options' => $convocatorias, 'empty' => 'Todas','class' => 'form-control','default' => $convocatoria_id,'type' => 'select', 'id' => 'convocatorias', 'label' => 'Convocatoria']);
            ?>
			</div>
			<div class="col-xs-4">
				<label for="termino">Término a buscar</label>
				<input type="text" class="form-control" name="termino" value="<?php if(isset($_GET['termino'])) echo $_GET['termino'];?>">
			</div>
			<div class="col-xs-4">    
				<label for="estado">Estado</label>
				<select name="estado" class="form-control">
					<option value="Todos"<?php if(isset($_GET['estado']) && $_GET['estado'] =='Todos') echo 'selected="selected" ';?>>Todos</option>
					<option value="Aceptadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='Aceptadas') echo 'selected="selected" ';?>>Aceptadas</option>
					<option value="No_evaluadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='No_evaluadas') echo 'selected="selected" ';?>>Asignadas No evaluadas</option>					
					<option value="No_Asignadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='No_Asignadas') echo 'selected="selected" ';?>>No asignadas</option>
                    <option value="No_cumple_requisitos"<?php if(isset($_GET['estado']) && $_GET['estado']=='No_cumple_requisitos') echo 'selected="selected" ';?>>No cumple los requisitos</option>
                    <option value="Reclamadas"<?php if(isset($_GET['estado']) && $_GET['estado']=='Reclamadas') echo 'selected="selected" ';?>>Reclamadas</option>
				</select>				
			</div>			
		</div>			
	  <button style="float: right" type="submit" class="btn btn-primary">Buscar</button>
	</form>               
	        </div>
	    </div>
	    </div>
	</div>
  <div class="container">
     <br>
      <div class="row">
      <div class="convocatorias index large-9 medium-8 columns content">
      <div class="list-group">  
      <table class="table table-hover table-bordered grid2" cellpadding="0" cellspacing="0" id='solicitudes_table'>
          <thead>
              <tr>
                <th scope="col">Convocatoria</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estado</th>
              </tr>
          </thead>        
          <tbody>
         <?php if(sizeof($solicitudes) !=0) { ?>       
          <?php foreach ($solicitudes as $solicitud): ?>
           <?php
              $estado = "";
              $clase = "";
              
              if($solicitud['usuario_evaluador'] == null) {
                  $estado = "No asignada";
                  $clase  = "info";     
              } else if (($solicitud['fechaReclamacion'] != null) || ($solicitud['fechaReclamacionEvaluacion'] != null)) {
                  $estado = "Reclamada";
                  $clase = "";
              } else if ($solicitud['aceptado'] == 1) {
                  $estado = "Aceptada";
                  $clase = "success";
              } else if ($solicitud['aceptado'] !== null) { 
                  $estado = "No cumple requisitos";
                  $clase = "warning";
              } else if (($solicitud['usuario_evaluador']) != null && ($solicitud['aceptado']) === null){
                  $estado = "Asignadas No evaluadas";
                  $clase = "light";
              }
           ?>
            <tr class="<?= $clase ?>" style="cursor: pointer;" onclick="window.location='/solicitudes/ver/<?=$solicitud['id']?>'">
                <td><?= $solicitud['convocatoria']['Nombre']?></td>
                <td><?= $solicitud['usuario']['Nombre']." ".$solicitud['usuario']['Apellidos']?></td >
                <td><?= $estado ?></td>
            </tr>
          <?php endforeach; ?>       
          </tbody> 
          </table>
          <?php } else { ?>
          </tbody> 
          </table>
          <div class="alert alert-danger alert-autocloseable-danger">
  		     <p class="text-center">No se encuentran registros.</p>
          </div>
          <?php } ?>  
          <?php    
            $count = $this->request->getParam('paging.Solicitudes.count');
              
            if($count>20) { 
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
       </div>    
    </div>                 
  </div>      	          	          	          
</div>