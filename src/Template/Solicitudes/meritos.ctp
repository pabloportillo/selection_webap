<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<style>
	th {
		width: 15%;
	}

	.right {
		float: right;
	}
	
/*FOTO*/
    img.pequena{
      width: 50px; height: 50px;
      cursor: pointer;     
    }
    img.mediana{
      width: 100px; height: 100px;
      cursor: pointer;     
    }
    img.grande{
      width: 200px; height: 200px;
      cursor: pointer;     
    }
    img.normal{
      width: 400px; height: 300px;
      cursor: pointer;        
    }
	img.foto{
      width: 300px; height: 300px;
    }
	
.img {
    position: relative;
    float: left;
    width:  100px;
    height: 100px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;
}	
/*----*/

/*PÁGINA*/
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}	
/*----*/

/*PARA MERITOS Y PUNTUACION MAX*/
.alignleft {
	float: left;
}
.alignright {
	float: right;
}

/*----*/
.SelectArea { width:400px;}

/*----*/
 .container {
    position: relative;
}

/* Bottom right text */
.text-block {
    position: absolute;
    bottom: 0px;
    left: 15px;
    background-color: #C70039;
    color: white;
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 10px;
}    
</style>

<?php
if (isset($_GET['success_add_exclusion_motivo'])) { ?>
	<div class="alert alert-success">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  El motivo de exclusión se guardó correctamente.
	</div>
<?php } ?>

<div class="panel">
	<div class="panel-body">
	  <div class="row">
		<div class="col-md-3 col-lg-3 " align="center">
		<!-- class="img-rounded img-responsive" -->
		<img class="foto" src="data:image/jpg;base64,<?= stream_get_contents($solicitude->usuario->Foto) ?>">
		</div>
		<div class=" col-md-9 col-lg-9 "> 
		  <table class="vertical-table table table-striped table-bordered grid2">
			<tbody>
			  <tr>
				<th scope="row">Nombre</th>
				<td><?=h($solicitude->usuario->Nombre) ?></td>
			  </tr>
			  <tr>   
				<th scope="row">Apellidos</th>
				<td><?=h($solicitude->usuario->Apellidos) ?></td>
			  </tr>
			  <tr>
				<th scope="row">E-mail</th>
				<td><?=h($solicitude->usuario->Email) ?></td>
			  </tr>
			  <tr>  
				<th scope="row">Teléfono</th>
				<td><?=h($solicitude->usuario->Telefono) ?></td>
			  </tr>
			  <tr>
				<th scope="row">DNI/NIE</th>
				<td><?=h($solicitude->usuario->Dni) ?></td>
			  </tr>
			  <tr>  
				<th scope="row">Dirección</th>
				<td><?=h($solicitude->usuario->Direccion) ?></td>
			  </tr>
			  <tr>
				<th scope="row">Localidad</th>
				<td><?=h($solicitude->usuario->Localidad) ?></td>
			  </tr>
			  <tr>  
				<th scope="row">CP</th>
				<td><?=h($solicitude->usuario->Cp) ?></td>
			  </tr>
			</tbody> 
		  </table>            
		</div>
	  </div>
	</div>
</div>
<!--
---------------------------------------- CONVOCATORIA ----------------------------------------
--> 
<div class=" col-md-12 col-lg-19 "> 
    <div class="panel-group" id="accordion" role="tablist">
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Convocatoria <i class="fa fa-chevron-down pull-right"></i></a></h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body" id="divFiltro">   

                <div class="panel">
                    <div class="panel-body">
                        <div class=" col-md-12 col-lg-19 "> 
                              <table class="vertical-table table grid2" id="convocatoria_table">
                                  <tr>
                                    <th scope="row">Nombre</th>
                                    <td><?=h($solicitude->convocatoria->Nombre) ?></td>
                                  </tr>
                                  <tr>   
                                    <th scope="row">Descripción</th>
                                    <td><?= html_entity_decode($solicitude->convocatoria->Descripcion) ?></td>
                                  </tr>
                              </table>	
                        </div>
                    </div>
                </div>                                          
                </div>
            </div>
        </div>
    </div>
</div>
<?php $reclamacion = false;?>
<?php if(!empty($solicitude->reclamaciones)) {?>
<div id="DivReclamacion" class="panel">
    <div class=" col-md-12 col-lg-19 ">
    <h2>Reclamación</h2>
    <?php foreach ($solicitude->reclamaciones as $reclamacion): ?>
    <?php if($reclamacion->tipo == "admision"){?>
    <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5" maxlength="3550" readonly>
    <?php echo $reclamacion->descripcion;?>
    </textarea>
    <?php $reclamacion=true;}?>
    <?php endforeach; ?> 
    </div>
</div>
<?php }?>   
  
<!--
---------------------------------------- MERITOS ----------------------------------------
--> 
<div id="DivMeritos" class="panel">
	<div class="panel-body">
		<div class=" col-md-12 col-lg-19 " id="ParentContainer" >
		   <div class="table-responsive" id="FixedDiv" >
              <table id="sticky-table-header" class="table sticky-table-header">
			    <tr style="white-space:nowrap;">
					<th class="fill"><h2>Meritos</h2></th>
					<th scope="row" style="white-space:nowrap;">
						<h2>Auto Puntuación</h2>
						<input type="text" value="<?= $solicitude->autoPuntuacion ?>" size="2" disabled>
					</th>
					<th></th>
					<th scope="row" style="white-space:nowrap;">
						<h2>Puntuación Evaluación</h2>
						<input type="text" id="puntuacion" value="<?= $solicitude->puntuacionEvaluacion ?>" size="2" disabled>
					</th>
				</tr>
 			</table>
            <script>
                $('#ParentContainer').scroll(function() { 
                    $('#FixedDiv').css('top', $(this).scrollTop());
                });
            </script> 			
 			</div>
				<div class="list-group"> <!-- <a class="list-group-item active"> -->
 				<?php
                    $solicitud_has_merito_id = "";
                    $ultimo_solicitud_has_merito= "";

                    foreach ($solicitud_has_meritos as $solicitud_has_merito): 
                    
                    $tipe = ($solicitud_has_merito['meritos']['tipos_meritos_id'] == 1 ? 'FORMACION' : 'EXPERIENCIA');
  
                    if($solicitud_has_merito_id == ""){
                ?>
			  	  <?= $this->Form->create($solicitud_has_merito, ['name' => 'searchMeritos', 'id' => 'searchMeritos']) ?>
					  <a class="list-group-item">    
					    <p><input type="text" value="<?= $tipe ?>" size="11" disabled></p>   
						<strong><?php echo $solicitud_has_merito['meritos']['descripcion']; ?></strong>
						<p><?php echo $solicitud_has_merito['evidencias']['descripcionEvidencia']; ?></p>
						
						<?php if($solicitud_has_merito['evidencias']['extension'] == 'pdf') {?>
                           <div class="container"> 
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                           
    				       </div>		
						<?php }else{ ?>
                           <div class="container">
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                           
    				       </div> 		
						<?php } ?>
						
<!------------------------------------------------------------------------------------------------------------->
				<?php }else if($solicitud_has_merito_id == $solicitud_has_merito->id){?>
						<?php if($solicitud_has_merito['evidencias']['extension'] == 'pdf') {?>
                           <div class="container">
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                          
    				       </div>
						<?php }else{ ?>
                           <div class="container">
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                          
    				       </div>		
						<?php } ?>
<!------------------------------------------------------------------------------------------------------------->               
                <?php }else if($solicitud_has_merito_id != "" && $solicitud_has_merito_id != $solicitud_has_merito->id){?>
                        <br><br>
                        <?php if($perfil != 4) { ?>
						<div class="SelectArea">
                            <?= $this->Form->control('merito_id', ['options' => $other_meritos, 'empty' => true,'class' => 'form-control', 'label' => '¿Pertenece esta/s evidencia/s a otro mérito?', 'id' => 'select_'.$ultimo_solicitud_has_merito->id]); ?>        
                        </div>
						<br>
						<?php } ?>                        	
						Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_merito['valido'] == 1)? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_merito['valido'] == 0 && $ultimo_solicitud_has_merito['valido'] != "")? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
						
						<?php /*
							echo "Valido ".$this->Form->control('valido',['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'id' => 'merito_'.$solicitud_has_merito['id']]); */
						?>
					  </a>
					  <hr>
					<script>
						$(document).ready(function() {

							$(".merito_<?= $ultimo_solicitud_has_merito['id'] ?>").change(function() {
								
								if (this.value == 1){
									var valido = 1;
								}else {
									var valido = 0;
								}
									  
								  var idsolicitudhasmerito = "<?= $ultimo_solicitud_has_merito['id'] ?>";
								  var url = "../evaluarmeritosolicitud";
								  var idsolicitud = "<?= $solicitude->id ?>";
                                
                                  console.log(idsolicitudhasmerito);
                                  console.log(url);
                                  console.log(valido);
                                  console.log(idsolicitud);

								  $.ajax({
											 url: url,
											 dataType: "JSON",
											 method: "POST",
											 data: { solicitudhasmerito_id: idsolicitudhasmerito, valido: valido, solicitud_id: idsolicitud }
										   }).done(function(json) {
												if(json.result){
													$("#puntuacion").val(json.suma);
													}	

										   }); 

							});
                            
                            $("#select_<?=$ultimo_solicitud_has_merito->id?>").change(function()  
                                {	
                                    var merito_selected = $(this).val();
                                    var merito_id = "<?= $ultimo_solicitud_has_merito->id ?>";
                                    var url = "../cambiarmeritoid";  
                                
                                    console.log("merito_selected = "+merito_selected);
                                    console.log("merito_id = "+merito_id);
                                
                                          $.ajax({
                                                     url: url,
                                                     dataType: "JSON",
                                                     method: "POST",
                                                     data: { selected: merito_selected, id: merito_id }
                                                   }).done(function(json) {
                                                        if(json.result){
                                                            //$("#DivMeritos").load(" #DivMeritos");
                                                            location.reload(); 
                                                            }	

                                                   }); 
    
                                });
						});
					</script>
				  <?= $this->Form->end() ?>
			  	  <?= $this->Form->create($solicitud_has_merito, ['name' => 'searchMeritos', 'id' => 'searchMeritos']) ?>
					  <a class="list-group-item">
					    <p><input type="text" value="<?= $tipe ?>" size="11" disabled></p> 
						<strong><?php echo $solicitud_has_merito['meritos']['descripcion']; ?></strong>
						<p><?php echo $solicitud_has_merito['evidencias']['descripcionEvidencia']; ?></p>
						
						<?php if($solicitud_has_merito['evidencias']['extension'] == 'pdf') {?>
                           <div class="container">
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                           
    				       </div>		
						<?php }else{ ?>
                           <div class="container">
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
                            <?php if(!is_null($solicitud_has_merito['evidencias']['reclamacion_id'])) {?>
                              <div class="text-block">
                                <h4>Evidencia Reclamación</h4>
                              </div>
                            <?php }?>                           
    				       </div>		
						<?php } ?>		
                <?php }
                    $solicitud_has_merito_id = $solicitud_has_merito->id; 
                    $ultimo_solicitud_has_merito = $solicitud_has_merito;
                    endforeach; 
                ?>
                        <br><br>
                        <?php if($perfil != 4) { ?>
						<div class="SelectArea">
                            <?= $this->Form->control('merito_id', ['options' => $other_meritos, 'empty' => true,'class' => 'form-control', 'label' => '¿Pertenece esta/s evidencia/s a otro mérito?', 'id' => 'select_'.$ultimo_solicitud_has_merito->id]); ?> 
                        </div>
                        <br>
                        <?php } ?>
						Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_merito['valido'] == 1)? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_merito['valido'] == 0 && $ultimo_solicitud_has_merito['valido'] != "")? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
                      </a>
					  <hr>
					<script>
						$(document).ready(function() {

							$(".merito_<?= $ultimo_solicitud_has_merito['id'] ?>").change(function() {
								
								if (this.value == 1){
									var valido = 1;
								}else {
									var valido = 0;
								}
									  
								  var idsolicitudhasmerito = "<?= $ultimo_solicitud_has_merito['id'] ?>";
								  var url = "../evaluarmeritosolicitud";
								  var idsolicitud = "<?= $solicitude->id ?>";

								  $.ajax({
											 url: url,
											 dataType: "JSON",
											 method: "POST",
											 data: { solicitudhasmerito_id: idsolicitudhasmerito, valido: valido, solicitud_id: idsolicitud }
										   }).done(function(json) {
												if(json.result){
													$("#puntuacion").val(json.suma);
													}	

										   }); 

							});
                            
                            $("#select_<?=$ultimo_solicitud_has_merito->id?>").change(function()  
                                {	
                                    var merito_selected = $(this).val();
                                    var merito_id = "<?= $ultimo_solicitud_has_merito->id ?>";
                                    var url = "../cambiarmeritoid";  
                                
                                    console.log("merito_selected = "+merito_selected);
                                    console.log("merito_id = "+merito_id);
                                
                                          $.ajax({
                                                     url: url,
                                                     dataType: "JSON",
                                                     method: "POST",
                                                     data: { selected: merito_selected, id: merito_id }
                                                   }).done(function(json) {
                                                        if(json.result){
                                                            //$("#DivMeritos").load(" #DivMeritos");
                                                            location.reload(); 
                                                            }	

                                                   }); 
    
                                });
						});
					</script>
                    <?= $this->Form->end() ?>
				</div>
                <?= $this->Html->link(__(''), ['controller' =>'solicitudes', 'action' => 'ver', $solicitude->id], ['id' => 'volver']) ?>				
				<button type="submit"  onclick="ResolveValidationMeritos()" class="btn btn-primary" style="float: right">Finalizar</button>	
 		</div>
  	</div>
</div> 

<script type="text/javascript">

/* ----------------------- SCRIPT PARA EVENTO DE BOTON "FINALIZAR EVALUACIÓN MERITOS" ------------------------*/

	
	function ResolveValidationMeritos() {
		
	  checkMeritos();
	}
	
    function insertlog() {
        var idsolicitud = "<?= $solicitude->id ?>";
        var url = "../meritoslog"; 

        $.ajax({
                 url: url,
                 dataType: "JSON",
                 method: "POST",
                 data: { id_solicitud: idsolicitud }
               }).done(function(json) {
                    if(json.result){
                    }else {
                        alert("Hubo un problema con la base de datos insertando datos en el log. Por favor, contacte con el administrador.")
                    }
               }); 
    }    
    
	function checkMeritos() {

		var meritos_por_validar = true;
				
		$('#searchMeritos input[type="radio"]').each(function() {
			
			var radioname = $(this).attr('name');
			var ver = $("input:radio[name ="+radioname+"]:checked").val();
			
			if((ver != 1) && (ver != 0) && meritos_por_validar) {
				meritos_por_validar = false;	
			}
		});
		
		if(meritos_por_validar == false)
		{
			window.alert("Le quedan méritos por validar");	
		}else {

              insertlog();    
            
			  var puntuacion = $("#puntuacion").val();
			  var idsolicitud = "<?= $solicitude->id ?>";
			  var url = "../novaliduser";
			  var valido = 1;
              <?php if($reclamacion){ ?>
              var reclamacion = 1;
              <?php }else{ ?>
              var reclamacion = 0;
              <?php } ?>             

			  $.ajax({ 
								 url: url,
								 dataType: "JSON",
								 method: "POST",
								 data: { solicitud_id: idsolicitud, valido: valido, puntuación_evaluacion: puntuacion, reclamacionEvaluacion: reclamacion}
							   }).done(function(json) {
									if(json.result){
									  document.getElementById('volver').click();
									}
							  });
		}
	}
    
</script>