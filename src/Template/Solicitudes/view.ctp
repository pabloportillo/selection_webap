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
<div class="panel">
	<div class="panel-body">
		<div class=" col-md-12 col-lg-19 "> 
 			<h2>Convocatoria</h2>
 			  <table class="vertical-table table table-striped table-bordered grid2" id="convocatoria_table">
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
<!--
---------------------------------------- REQUISITOS ---------------------------------------- 
-->   
<div id="DivRequisitos" class="panel">
	<div class="panel-body">
		<div class=" col-md-12 col-lg-19 "> 
 			<h2>Requisitos</h2>
 				<div class="list-group"> <!-- <a class="list-group-item active"> -->
 				<?php
                    $solicitud_has_requisito_id = "";
                    $ultimo_solicitud_has_requisito = "";

                    foreach ($solicitud_has_requisitos as $solicitud_has_requisito): 
  
                    if($solicitud_has_requisito_id == ""){
                ?>

                <?= $this->Form->create($solicitud_has_requisito, ['name' => 'searchForm', 'id' => 'searchForm']) ?>
                      <a class="list-group-item">
                        <strong><?php echo $solicitud_has_requisito['requisitos']['descripcion']; ?></strong>
                        <p><?php echo $solicitud_has_requisito['evidencias']['descripcionEvidencia']; ?></p>
                        <?php if($solicitud_has_requisito['evidencias']['extension'] == 'pdf') {?>
                            <iframe src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                        <?php }else{ ?>
                            <img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')">  
                        <?php } ?>
<!------------------------------------------------------------------------------------------------------------->
				<?php }else if($solicitud_has_requisito_id == $solicitud_has_requisito->id){?>
                        <?php if($solicitud_has_requisito['evidencias']['extension'] == 'pdf') {?>
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
						<?php }else{ ?>
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')">	
						<?php } ?>
<!------------------------------------------------------------------------------------------------------------->               
                <?php }else if($solicitud_has_requisito_id != "" && $solicitud_has_requisito_id != $solicitud_has_requisito->id){?>
                
                      <br><br>								
						Válido <input type="radio" id="ValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 1)? 'checked':'' ?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="NoValRadioReq_<?= $ultimo_solicitud_has_requisito['id']?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 0 && $ultimo_solicitud_has_requisito['valido'] != "" )? 'checked':'' ?>/> 
					  <br />
					  </a>
					  <hr>
					<script>
						$(document).ready(function() {

							$(".requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>").change(function() {
								
								if (this.value == 1){
									var valido = 1;
								}else {
									var valido = 0;
								}
									  
								  var idsolicitudhasrequisito = "<?= $ultimo_solicitud_has_requisito['id'] ?>";
								  var url = "../evaluarequisitosolicitud";

								  //console.log("idsolicitudhasrequisito id: "+idsolicitudhasrequisito);
								  //console.log("valido : "+valido);
								  //console.log(url);

								  $.ajax({
													 url: url,
													 dataType: "JSON",
													 method: "POST",
													 data: { solicitudhasrequisito_id: idsolicitudhasrequisito, valido: valido }
												   }).done(function() {
												   });
							});
						});
					</script>
					  <?= $this->Form->end() ?>	
					  <?= $this->Form->create($solicitud_has_requisito, ['name' => 'searchForm', 'id' => 'searchForm']) ?>					
					  <a class="list-group-item">
						<strong><?php echo $solicitud_has_requisito['requisitos']['descripcion']; ?></strong>
						<p><?php echo $solicitud_has_requisito['evidencias']['descripcionEvidencia']; ?></p>
						<?php if($solicitud_has_requisito['evidencias']['extension'] == 'pdf') {?>
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
						<?php }else{ ?>
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')">	
						<?php } ?>
                <?php }
                    $solicitud_has_requisito_id = $solicitud_has_requisito->id; 
                    $ultimo_solicitud_has_requisito = $solicitud_has_requisito; 
                    endforeach; 
                ?>   
                        <br><br>								
						Válido <input type="radio" id="ValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 1)? 'checked':'' ?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="NoValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 0 && $ultimo_solicitud_has_requisito['valido'] != "" )? 'checked':'' ?>/>
					  <br />
					  </a>
					  <hr>
					<script>
						$(document).ready(function() {

							$(".requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>").change(function() {
								
								if (this.value == 1){
									var valido = 1;
								}else {
									var valido = 0;
								}
									  
								  var idsolicitudhasrequisito = "<?= $ultimo_solicitud_has_requisito['id'] ?>";
								  var url = "../evaluarequisitosolicitud";

								  //console.log("idsolicitudhasrequisito id: "+idsolicitudhasrequisito);
								  //console.log("valido : "+valido);
								  //console.log(url);

								  $.ajax({
													 url: url,
													 dataType: "JSON",
													 method: "POST",
													 data: { solicitudhasrequisito_id: idsolicitudhasrequisito, valido: valido }
												   }).done(function() {
												   });
							});
						});
					</script>
					  <?= $this->Form->end() ?>
				</div>
				<!--En el button de abajo, en la propiedad de "onclick" llama a la funcion "ShowHideElement -->
        		<button id="RequisitosButton" onclick="ResolveValidation()" type="submit" class="btn btn-primary" style="float: right">Finalizar evaluación requisitos</button>	
 		</div> 		
  	</div>
</div>
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
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
						<?php }else{ ?>
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
						<?php } ?>
						
<!------------------------------------------------------------------------------------------------------------->
				<?php }else if($solicitud_has_merito_id == $solicitud_has_merito->id){?>
						<?php if($solicitud_has_merito['evidencias']['extension'] == 'pdf') {?>
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
						<?php }else{ ?>
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
						<?php } ?>
<!------------------------------------------------------------------------------------------------------------->               
                <?php }else if($solicitud_has_merito_id != "" && $solicitud_has_merito_id != $solicitud_has_merito->id){?>
                        <br><br>
						<div class="SelectArea">
                            <?= $this->Form->control('merito_id', ['options' => $other_meritos, 'empty' => true,'class' => 'form-control', 'label' => '¿Pertenece esta/s evidencia/s a otro mérito?', 'id' => 'select_'.$ultimo_solicitud_has_merito->id]); ?>        
                        </div>
						<br>                        	
						Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="1" <?php //echo ($ultimo_solicitud_has_merito['valido'] == 1)? 'checked':'' ?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="0" <?php //echo ($ultimo_solicitud_has_merito['valido'] == 0 && $ultimo_solicitud_has_merito['valido'] != "")? 'checked':'' ?>/>
						
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
    						<iframe src="data:application/pdf;base64,<?= $solicitud_has_merito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
						<?php }else{ ?>
    						<img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_merito['evidencias']['evidencia']?>')">
						<?php } ?>		
                <?php }
                    $solicitud_has_merito_id = $solicitud_has_merito->id; 
                    $ultimo_solicitud_has_merito = $solicitud_has_merito;
                    endforeach; 
                ?>
                        <br><br>
						<div class="SelectArea">
                            <?= $this->Form->control('merito_id', ['options' => $other_meritos, 'empty' => true,'class' => 'form-control', 'label' => '¿Pertenece esta/s evidencia/s a otro mérito?', 'id' => 'select_'.$ultimo_solicitud_has_merito->id]); ?> 
                        </div>
						<br>
						Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="1" <?php //echo ($ultimo_solicitud_has_merito['valido'] == 1)? 'checked':'' ?>/>
						&nbsp;&nbsp;
						No Válido <input type="radio" id="ValRadioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" class="merito_<?= $ultimo_solicitud_has_merito['id'] ?>" name="radioMer_<?= $ultimo_solicitud_has_merito['id'] ?>" value="0" <?php //echo ($ultimo_solicitud_has_merito['valido'] == 0 && $ultimo_solicitud_has_merito['valido'] != "")? 'checked':'' ?>/>
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
				<button type="submit"  onclick="ResolveValidationMeritos()" class="btn btn-primary" style="float: right">Finalizar evaluación meritos</button>	
 		</div>
  	</div>
</div> 
<!--
-------------------------------- SCRIPT PARA MOSTRAR/OCULTAR DIVS Y GUARDAR DATOS --------------------------------
--> 

<script type="text/javascript">
	/*
	*  PORTILLO:
	*
	* Script para mostrar y ocultar los divs "Requisitos" y "Meritos".
	*/
	
	//Ocultamos Méritos
	$("#DivMeritos").hide(); 
	
	// Si están todos los checkbox de requisitos checked, ocultamos el div requisitos.
	var evidencias_por_validar = true;
	
	$('#searchForm input[type="radio"]').each(function() {

		var radioname = $(this).attr('name');
		var ver = $("input:radio[name ="+radioname+"]:checked").val();

		if(ver != 1 && evidencias_por_validar) {
			
			evidencias_por_validar = false;
		}
	});
    
    window.onload = function() {
    		if(evidencias_por_validar)
		{ 
			ShowHideElement();
		}
    };
    

	
	function ResolveValidation() {
		checkChecked();	
	}
    
    function insertlog() {
        var idsolicitud = "<?= $solicitude->id ?>";
        var url = "../requisitoslog"; 

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
    
	function checkChecked() {
		
		var evidencias_validadas = true;
		var evidencias_por_validar = true;
				
		$('#searchForm input[type="radio"]').each(function() {
			
			var radioname = $(this).attr('name');
			var ver = $("input:radio[name ="+radioname+"]:checked").val();
			
			if(ver != 1 && evidencias_por_validar) {
					
				if(ver == 0 ) {
					if (evidencias_validadas){
						evidencias_validadas = false;
					}
				}else{
				evidencias_por_validar = false;
					  
				}		
			}
		});
		
		if(evidencias_por_validar == false)
		{
			window.alert("Le quedan evidencias por validar");	
		}else 
		{
			if(evidencias_validadas == false){
					
              var idsolicitud = "<?= $solicitude->id ?>";
              var url = "../novaliduser";
              var valido = 0;   

              $.ajax({
                                 url: url,
                                 dataType: "JSON",
                                 method: "POST",
                                 data: { solicitud_id: idsolicitud, valido: valido }
                               }).done(function(json) {
                                    if(json.result){
                                      window.location.href = "../";
                                    }
                               });

			}else
			{
                
                insertlog();
                
                var idsolicitud = "<?= $solicitude->id ?>";
                var url = "../validoevaluacionrequisitos"; 

                $.ajax({
                                 url: url,
                                 dataType: "JSON",
                                 method: "POST",
                                 data: { solicitud_id: idsolicitud }
                               }).done(function(json) {
                                    if(json.result){
                                      ShowHideElement();
                                    }else {
                                        alert("Hubo un problema con la base de datos evaluando los requisitos. Por favor, contacte con el administrador.")
                                    }
                               });
			}
		}
	}

    function ShowHideElement() {
		
		$("#DivRequisitos").hide(); 
		$("#DivMotivos").hide();
		$("#DivMeritos").show();
    } 
/* ----------------------- SCRIPT PARA EVENTO DE BOTON "FINALIZAR EVALUACIÓN MERITOS" ------------------------*/

	
	function ResolveValidationMeritos() {
		
	  checkMeritos();
	}
	
    function insertlogmeritos() {
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
		}else 
		{
			<?php 
				if(!empty($solicitud_exclusion_motivos))
				{	
			?>
				 window.alert("No se puede guardar la evaluación de méritos si se encuentran motivos de exclusion añadidos a la solicitud.");	
			<?php 
				}else{
			?>
			
              insertlogmeritos(); 
            
			  var puntuacion = $("#puntuacion").val();
			  var idsolicitud = "<?= $solicitude->id ?>";
			  var url = "../novaliduser";
			  var valido = 1;   

			  $.ajax({ 
								 url: url,
								 dataType: "JSON",
								 method: "POST",
								 data: { solicitud_id: idsolicitud, valido: valido, puntuación_evaluacion: puntuacion}
							   }).done(function(json) {
									if(json.result){
									  window.location.href = "../";
									}
							  });	

			<?php 
				}
			?>
		}
	}
    
/* ----------------------- SCRIPT PARA AÑADIR Y ELIMINAR MOTIVOS DE EXCLUSION ------------------------*/ 

    /*Función para añadir motivo de exclusión 
    function addMotivoExclusion()
    {
        
        $('#overlay').show();
        
        var motivo_id = $("#motivo_selected").val();
        var solicitud_id = $("#solicitud_id").val();
        var url = "../../SolicitudHasExclusionMotivos/addbyajax";
                
        $.ajax({
              url: url,
              dataType: "JSON",
              method: "POST",
              data: { exclusion_motivo_id: motivo_id, solicitude_id: solicitud_id},
              success: function(data){
                // onSuccess take only the container content
                var content =  $($.parseHTML(data)).filter("#DivMotivos"); 
                //Replace content inside the div
                $('#DivMotivos').html(content);
                // HIDE the overlay:
                $('#overlay').hide();
            }
            }).done(function(json) {
                 if(json.result){
                     location.reload(); 
                     //$("#DivMotivos").load(" #DivMotivos");
                     /* INFO: Refrescamos la página entera en vez del DivMotivos
                      * porque a veces hay problemas a la hora de eliminar los motivos de exclusion.
                      
                 }	
            });
        
    }
    
    /*Esto crea el gif de loading cuando la pantalla está en carga
    $(document).ready(function(){
        // Create overlay and append to body:
        $('<div id="overlay"/>').css({
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100%',
            height: $(window).height() + 'px',
            opacity:0.4, 
            background: 'lightgray url(https://media1.tenor.com/images/a6a6686cbddb3e99a5f0b60a829effb3/tenor.gif?itemid=7427055) no-repeat center'
        }).hide().appendTo('body');
    });
    */
</script>
<script>
    <?php if(isset($solicitude->valido_evaluacion_requisitos) && ($solicitude->valido_evaluacion_requisitos == 1)) { ?>
        ShowHideElement();
    <?php } else {?>
        console.log("No existe");
    <?php } ?>
</script>