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
    
.table > tbody > tr:first-child > td {
    border: none;
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

#motivo_selected {
padding: 2px;   
}    
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

<div class="panel">
	<div class="panel-body">
	  <div class="row">
		<div class="col-md-3 col-lg-3 " align="center">
		<!-- class="img-rounded img-responsive" -->
		<img class="foto" src="data:image/jpg;base64,<?= stream_get_contents($solicitude->usuario->Foto) ?>">
		</div>
		<div class="col-md-9 col-lg-9 "> 
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
---------------------------------------- REQUISITOS ---------------------------------------- 
-->   
<div id="DivRequisitos" class="panel">
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
                       <div class="container">                        
                        <iframe id="pdf_<?=$solicitud_has_requisito['evidencias']['id']?>" src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                        
                       </div>
                       <br>                        
                    <?php }else{ ?>
                       <div class="container">                        
                        <img id="image_<?=$solicitud_has_requisito['evidencias']['id']?>" class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')">
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                         
                       </div>
                       <br>         
                    <?php } ?>
<!------------------------------------------------------------------------------------------------------------->
            <?php }else if($solicitud_has_requisito_id == $solicitud_has_requisito->id){?>
                    <?php if($solicitud_has_requisito['evidencias']['extension'] == 'pdf') {?>
                       <div class="container">                       
                        <iframe id="pdf_<?=$solicitud_has_requisito['evidencias']['id']?>" src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                           
                       </div>
                       <br>                            
                    <?php }else{ ?>
                       <div class="container">                        
                        <img id="image_<?=$solicitud_has_requisito['evidencias']['id']?>" class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')"> 
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                         
                       </div>
                       <br>              
                    <?php } ?>
<!------------------------------------------------------------------------------------------------------------->               
            <?php }else if($solicitud_has_requisito_id != "" && $solicitud_has_requisito_id != $solicitud_has_requisito->id){?>

                  <br><br>								
                    Válido <input type="radio" id="ValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 1)? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
                    &nbsp;&nbsp;
                    No Válido <input type="radio" id="NoValRadioReq_<?= $ultimo_solicitud_has_requisito['id']?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 0 && $ultimo_solicitud_has_requisito['valido'] != "" )? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/> 
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
                       <div class="container"> 
                        <iframe src="data:application/pdf;base64,<?= $solicitud_has_requisito['evidencias']['evidencia'] ?>" frameborder="0" height="300px" width="400px"></iframe>
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                        
                       </div>    
                    <?php }else{ ?>
                       <div class="container"> 
                        <img class="normal" style="vertical-align: top" src="data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>" onclick="window.open('data:image/jpg;base64,<?= $solicitud_has_requisito['evidencias']['evidencia']?>')">
                        <?php if(!is_null($solicitud_has_requisito['evidencias']['reclamacion_id'])) {?>
                          <div class="text-block">
                            <h4>Evidencia Reclamación</h4>
                          </div>
                        <?php }?>                        
                       </div>       	
                    <?php } ?>   
            <?php }
                $solicitud_has_requisito_id = $solicitud_has_requisito->id; 
                $ultimo_solicitud_has_requisito = $solicitud_has_requisito; 
                endforeach; 
            ?>   
                    <br><br>								
                    Válido <input type="radio" id="ValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="1" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 1)? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
                    &nbsp;&nbsp;
                    No Válido <input type="radio" id="NoValRadioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" class="requisito_<?= $ultimo_solicitud_has_requisito['id'] ?>" name="radioReq_<?= $ultimo_solicitud_has_requisito['id'] ?>" value="0" <?php echo ($ultimo_solicitud_has_requisito['valido'] == 0 && $ultimo_solicitud_has_requisito['valido'] != "" )? 'checked ':'' ?><?php echo ($perfil ==4)? 'disabled':''?>/>
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
    </div> 		
</div>

<div class=" col-md-12 col-lg-19 ">
    <?= $this->Html->link(__(''), ['controller' =>'solicitudes', 'action' => 'ver', $solicitude->id], ['id' => 'volver']) ?>    
    <button id="RequisitosButton" onclick="ResolveValidation()" type="submit" class="btn btn-primary" style="float: right">Finalizar</button>	
</div>

<!--
-------------------------------- SCRIPT PARA MOSTRAR/OCULTAR DIVS Y GUARDAR DATOS --------------------------------
--> 

<script type="text/javascript">
	
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
                
                  insertlog();
                
                  var idsolicitud = "<?= $solicitude->id ?>";
                  var url = "../novaliduser";
                  var valido = 0;   
                  <?php if($reclamacion){ ?>
                  var reclamacion = 1;
                  <?php }else{ ?>
                  var reclamacion = 0;
                  <?php } ?>                 

                  $.ajax({
                         url: url,
                         dataType: "JSON",
                         method: "POST",
                         data: { solicitud_id: idsolicitud, valido: valido, reclamacion: reclamacion }
                       }).done(function(json) {
                            if(json.result){
                              //window.location.href = "../";
                               document.getElementById('volver').click();
                            }
                       });
			}else {
                
                var idsolicitud = "<?= $solicitude->id ?>";
                var url = "../validoevaluacionrequisitos"; 

                $.ajax({
                         url: url,
                         dataType: "JSON",
                         method: "POST",
                         data: { solicitud_id: idsolicitud }
                       }).done(function(json) {
                            if(json.result){
                               //console.log("volver");
                               //alert("volver");
                               document.getElementById('volver').click();
                            }else {
                                alert("Hubo un problema con la base de datos evaluando los requisitos. Por favor, contacte con el administrador.")
                            }
                       });
			}
		}
	}
</script>
<script>
    <?php if(isset($solicitude->valido_evaluacion_requisitos) && ($solicitude->valido_evaluacion_requisitos == 1)) { ?>
        //ShowHideElement();
    <?php } else {?>
        console.log("No existe");
    <?php } ?>
</script>