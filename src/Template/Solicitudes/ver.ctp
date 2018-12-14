<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 
 
<div class="list-group">  
  <table class="table table-hover table-bordered grid2" cellpadding="0" cellspacing="0" id='solicitudes_table'>
      <thead>
          <tr>
            <th scope="col">Puntuacion Evaluacion</th>
            <th scope="col">Puntuacion</th>
            <th scope="col">Estado</th>
          </tr>
      </thead>        
      <tbody>   
        <tr class="" style="cursor: pointer;" >
            <td></td>
            <td></td >
            <td></td>
        </tr>

      </tbody> 
  </table>           
</div> 
 
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
</style>

<?php 

$reclamacion_requisito = false;
$reclamacion_merito = false;
$message = false;

if(isset($solicitude->fechaReclamacion) && is_null($solicitude->reclamacion)){ 
    $reclamacion_requisito = true;
}

if(isset($solicitude->fechaReclamacionEvaluacion) && is_null($solicitude->reclamacionEvaluacion)){
    $reclamacion_merito = true;
}

if(($reclamacion_requisito == false) && ($reclamacion_merito == false)){
    $requisito_button = "btn btn-primary";
    $merito_button = "btn btn-primary";
}else if(($reclamacion_requisito == true) && ($reclamacion_merito == false)){
    $requisito_button = "btn btn-danger";
    $merito_button = "btn btn-primary";
    $message = 'Reclamación en Requisitos por evaluar';
}else if(($reclamacion_requisito == false) && ($reclamacion_merito == true)){
    $requisito_button = "btn btn-primary";
    $merito_button = "btn btn-danger";
    $message = 'Reclamación en Meritos por evaluar';
}else if(($reclamacion_requisito == true) && ($reclamacion_merito == true)){
    $requisito_button = "btn btn-danger";
    $merito_button = "btn btn-danger";
    $message = 'Reclamación en Requisitos y Meritos por evaluar';
}

if($message) { ?>
    <div class="alert alert-danger alert-autocloseable-danger">
       <p class="text-center"><?=$message?></p>   
    </div>
<?php }?>

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
<br><br><br>
<!--
------------------------------------------- LOG -------------------------------------------
-->        
<div class=" col-md-12 col-lg-19 "> 
    <div class="panel-group" id="accordion2" role="tablist">
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">Log <i class="fa fa-chevron-down pull-right"></i></a></h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body" id="divFiltro">   
                <div class="panel">
                    <div class="panel-body">
                        <div class=" col-md-12 col-lg-19 "> 
                          <table class="table table-striped table-bordered grid2" id="informacion_table">
                            <tr>
                              <th class="fill">Usuario</th>
                              <th> Fecha</th>
                              <th> Acción</th>
                              <!--<th  class="acciones">Acciones</th>-->
                            </tr>
                            <?php foreach($logs as $log) : ?>
                              <tr class="sortable" >	    
                                <td><?= $log['usuarios']['Nombre']." ".$log['usuarios']['Apellidos'] ?></td>
                                <td><?= $log['fecha'] ?></td>
                                <td><?= $log['descripcion'] ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </table>
                        </div>
                    </div>
                </div>                                          
                </div>
            </div>
        </div>
    </div>
</div> 
<br><br><br>
<!--
-------------------------------------- MOTIVOS DE EXCLUSION ---------------------------------------
-->
<?php if($estado == "No cumple requisitos") {?> 
<div class=" col-md-12 col-lg-19 "> 
    <div class="panel-group" id="accordion3" role="tablist">
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="false" aria-controls="collapseOne">Motivos de Exclusion <i class="fa fa-chevron-down pull-right"></i></a></h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body" id="divFiltro">   
                <div class="panel">
                    <div class="panel-body">
                        <div class=" col-md-12 col-lg-19 "> 
                          <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id='motivos_exclusion'>
                           <tbody>
                            <?php foreach ($solicitud_has_requisitos as $requisito): ?>
                            <tr class="sortable" >	    
                                <td><?= $requisito['requisitos']['motivo_exclusion'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                           </tbody>    
                          </table>
                        </div>
                    </div>
                </div>                                          
                </div>
            </div>
        </div>
    </div>
</div> 
<br><br><br> 
<?php } ?> 

<!--
------------------------------------------- BOTONES -------------------------------------------
-->
<br> 
<div class="container">
<div class=" col-md-12 col-lg-19 "> 
 <div class="row">
  <div class="col-md-4">
    <table style="border-spacing: 0 1em;" class="table" cellpadding="0" cellspacing="0" id="solicitudes_table">
    <tbody>
        <tr>
            <td class="col-md-4" align="center" ><h3>Estado</h3></td>
            <td class="col-md-8">
                <input class="form-control" type="text" value="<?= $estado ?>" style="text-align: center;" readonly> 
            </td>
        </tr>       
    </tbody>
    </table>     
  </div>  
  <div class="col-md-4">
  <table style="border-spacing: 0 1em;" class="table" cellpadding="0" cellspacing="0" id="solicitudes_table">
    <tbody>
        <tr>
            <td class="col-md-4" align="center" ><h3>Evaluador</h3></td>
            <td class="col-md-8">
            <?php
            
            if($perfil == 4) {
                echo $this->Form->control('usuario_evaluador', ['options' => $usuarios, 'empty' => 'Sin asignar','class' => 'form-control','default' => $solicitude->usuario_evaluador ,'type' => 'select', 'id' => 'select','disabled' => 'true','templates' => ['inputContainer' => '{{content}}'], 'label' => false]);
            }else{
                echo $this->Form->control('usuario_evaluador', ['options' => $usuarios, 'empty' => 'Sin asignar','class' => 'form-control','default' => $solicitude->usuario_evaluador ,'type' => 'select', 'id' => 'select','templates' => ['inputContainer' => '{{content}}'], 'label' => false]); 
            }
            ?>                   
            </td>
        </tr>
        <script>
        $(document).ready(function() {

            function insertlog() {
                var idsolicitud = "<?= $solicitude->id ?>";
                var url = "../asignarlog"; 

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
            
            $("#select").change(function() {	
                  
                  insertlog();
                
                  var evaluadorid = $(this).val();
                  var idsolicitud = "<?= $solicitude->id ?>";
                  var url = "../cambiarusuarioevaluador";

                  $.ajax({
                                     url: url,
                                     dataType: "JSON",
                                     method: "POST",
                                     data: { solicitud_id: idsolicitud, usuario_evaluador: evaluadorid }
                                   }).done(function(json) {
                                        if(json.result){
                                            location.reload(); 
                                        }	
                                   });

            });
        });
        </script>        
    </tbody>
  </table>     
  </div> 
  <div style="text-align: center;" class="col-md-4">
      <button type="button" onclick="window.location='/solicitudes/requisitos/<?=$solicitude->id?>'" class="<?=$requisito_button?>" >Requisitos</button> <?//php if($estado == "No asignada"){ echo "disabled"; } ?> 

      <button type="button" onclick="window.location='/solicitudes/meritos/<?=$solicitude->id?>'" class="<?=$merito_button?>">Meritos</button><?//php if(($estado == "No cumple requisitos") || ($estado == "No asignada")){ echo "disabled"; } ?> 
      
      <?php if(!empty($solicitude->reclamacion) || !empty($solicitude->reclamacionEvaluacion) || ($solicitude->reclamacion != "") || ($solicitude->reclamacionEvaluacion != "")) { ?>
          <button type="button" id="habilitarreclamacion" onclick="habilitarreclamacion(<?=$solicitude->id?>)" class="btn btn-primary">Habilitar Reclamación</button>
      <?php } ?>
  </div>
</div> 
</div>
</div>
<!--
------------------------------------------- PUNTUACIONES -------------------------------------------
-->
<?php if(!empty($solicitude->puntuacionEvaluacion) || ($solicitude->puntuacionEvaluacion != "")) {?>
 <br> 
  <div class="container" id="puntuaciones">
      <div class="row">
       <div class="col-lg-4 col-lg-offset-4 text-left"> 
        <h4>Puntuaciones</h4>
        <p></p>
         <div id="DivMeritosOutside">
        <table style="border-spacing: 0 1em;" class="table table-responsive">
            <thead>
              <tr>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="col-md-7"><h3>Evaluación</h3></td>
                <td class="col-md-5">
                    <input class="form-control" type="text" value="<?= $solicitude->puntuacionEvaluacion ?>" style="text-align: center;" readonly> 
                </td>
              </tr>
              <tr>
                <td ><h3>Conocimiento</h3><p id='p_conocimiento' style='color:red'></p></td>
                <td >
                    <input class="form-control" id="conocimiento" type="text" value="<?= $solicitude->puntuacionConocimiento  ?>" style="text-align: center;" maxlength="3">
                </td>
                <td><button type="button" onclick="puntuacionconocimiento(<?=$solicitude->id?>)" class="btn btn-primary btn-xs">Añadir/Editar</button></td>
              </tr>
              <tr>
                <td><h3>Psicotécnico</h3><p id='p_psicotecnico' style='color:red'></p></td>
                <td>
                    <input class="form-control" id="psicotecnico" type="text" value="<?= $solicitude->puntuacionPsicotecnico ?>" style="text-align: center;" maxlength="3"> 
                </td>
                <td><button type="button" onclick="puntuacionpsicotecnico(<?=$solicitude->id?>)" class="btn btn-primary btn-xs">Añadir/Editar</button></td>
              </tr>
              <tr>
                <td><h3>Entrevista</h3><p id='p_entrevista' style='color:red'></p> </td>
                <td>
                    <input class="form-control" id="entrevista" type="text" value="<?= $solicitude->puntuacionEntrevista ?>" style="text-align: center;" maxlength="3">
                </td>
                <td><button type="button" onclick="puntuacionentrevista(<?=$solicitude->id?>)" class="btn btn-primary btn-xs" >Añadir/Editar</button></td>
              </tr>              
            </tbody>
          </table>
        </div>
       </div>    
    </div>                 
  </div>
<?php }?>  
<script>    
    function puntuacionconocimiento(id){
        
        valid = false;
        c = document.getElementById("conocimiento").value;
        
        if(c==null || c=="") {
            document.getElementById("p_conocimiento").innerHTML="Introduzca un valor numérico."; 
        }else {
            if (isNaN(parseInt(c))) {
                document.getElementById("p_conocimiento").innerHTML="Introduzca un valor numérico.";
            }else {
                document.getElementById("p_conocimiento").innerHTML="";
                
                var url = "../conocimientopuntuacion";
                
                 $.ajax({
                       url: url,
                       dataType: "JSON",
                       method: "POST",
                       data: { id: id, puntuacion: c},
                       success: function(data){

                     }
                     }).done(function(json) {
                          if(json.result){
                              location.reload();  
                          }else {
                              alert("Hubo un fallo guardando la puntuación. Por favor contacte con el administrador.")
                          }	
                     }); 
            }   
        }    
    }
    
    function puntuacionpsicotecnico(id){
        valid = false;
        c = document.getElementById("psicotecnico").value;
        
        if(c==null || c=="") {
            document.getElementById("p_psicotecnico").innerHTML="Introduzca un valor numérico."; 
        }else {
            if (isNaN(parseInt(c))) {
                document.getElementById("p_psicotecnico").innerHTML="Introduzca un valor numérico.";
            }else {
                document.getElementById("p_psicotecnico").innerHTML="";
                
                var url = "../psicotecnicopuntuacion";
                 $.ajax({
                       url: url,
                       dataType: "JSON",
                       method: "POST",
                       data: { id: id, puntuacion: c},
                       success: function(data){

                     }
                     }).done(function(json) {
                          if(json.result){
                              location.reload();  
                          }else {
                              alert("Hubo un fallo guardando la puntuación. Por favor contacte con el administrador.")
                          }	
                     }); 
            }   
        }
    }
    
    function puntuacionentrevista(id){
        valid = false;
        c = document.getElementById("entrevista").value;
        
        if(c==null || c=="") {
            document.getElementById("p_entrevista").innerHTML="Introduzca un valor numérico."; 
        }else {
            if (isNaN(parseInt(c))) {
                document.getElementById("p_entrevista").innerHTML="Introduzca un valor numérico.";
            }else {
                document.getElementById("p_entrevista").innerHTML="";
                
                var url = "../entrevistapuntuacion";
                 $.ajax({
                       url: url,
                       dataType: "JSON",
                       method: "POST",
                       data: { id: id, puntuacion: c},
                       success: function(data){

                     }
                     }).done(function(json) {
                          if(json.result){
                              location.reload();  
                          }else {
                              alert("Hubo un fallo guardando la puntuación. Por favor contacte con el administrador.")
                          }	
                     }); 
            }   
        }      
    }
    
    function habilitarreclamacion(id){
        var url = "../habilitarreclamacion";
         $.ajax({
               url: url,
               dataType: "JSON",
               method: "POST",
               data: { id: id},
               success: function(data){

             }
             }).done(function(json) {
                  if(json.result){
                      location.reload();  
                  }else {
                      alert("Hubo un fallo guardando la puntuación. Por favor contacte con el administrador.")
                  }	
             }); 
    }
    
</script>