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

    #DivMeritosOutside{
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    #DivMeritosInside{
        padding-top: 50px;
        padding-right: 50px;
        padding-bottom: 50px;
        padding-left: 50px;  
    }
    
    .MeritoElement {
        margin-top: 20px;
    }
    
    .RequisitoElement{
        margin-top: 20px;  
    }
    
</style>
<div class="solicitudes view large-9 medium-8 columns content">
   <div id="solicitud" class="container">
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-center"><h1><?=$convocatoria->Nombre?></h1></div>   
    </div>
    <br>
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
          <h3>Descripción</h3>
           <pre><?= html_entity_decode($convocatoria->Descripcion) ?>
           </pre>
       </div>    
    </div>    
    <div class="row">
     <div class="col-lg-6 col-lg-offset-3 text-left">    
      <div style="margin-top:20px;">
        <table class="table table-condensed">
         <tbody>
           <tr>
             <td class="text-right">Fecha Alta:</td>
             <td class="text-left"><?=$convocatoria->FechaAltaConvocatoria?></td>
             <td class="text-right">Fecha Baja:</td>
             <td class="text-left"><?=$convocatoria->FechaBajaConvocatoria?></td>
           </tr>
         </tbody>
        </table>
     </div>  
     </div>    
    </div>
    <br>     
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
          <h3>Información de interés</h3>
             <ul class="list-group">
             <?php foreach ($convocatoria->archivossubidos as $archivossubido): ?>
                <li><?= $this->Form->postLink($archivossubido->Descripcion, ['controller' => 'Archivossubidos','action' => 'download','archivo' => $archivossubido->Archivo],['class'=>"list-group-item", 'style'=>"color:blue"]) ?></li>
              <?php endforeach; ?>
             </ul>  
       </div>    
    </div>
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
         <form action="/action_page.php">
          <input type="checkbox" id="DecResp" name="vehicle" value="Bike"> He leido la <a href="" style="color:blue">declaración responsable</a><br>
          <p id='p_DecResp' style='color:red'></p>
         </form>  
       </div>    
    </div>
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-right">
        <button type="button" class="btn btn-primary" onclick="CreateSolicitud()">Siguiente</button>
        <script>
            function CreateSolicitud(){
                
                if (document.getElementById("DecResp").checked == false){
                    document.getElementById("p_DecResp").innerHTML="Acepte la Declaración Responsable."; 
                    return false;
                }else {
                    document.getElementById("p_DecResp").innerHTML="";
                    
                    <?php if(!isset($solicitud)) { ?>
                        //Ajax para crear la solicitud
                        var id_convocatoria = "<?= $convocatoria->id ?>";
                        var url = "../createsolicitud";  

                        $.ajax({ 
                                     url: url,
                                     dataType: "JSON",
                                     method: "POST",
                                     data: { convocatoria_id: id_convocatoria}
                                   }).done(function(json) {
                                        if(json.result){
                                          location.reload();
                                        }else {
                                            alert("La Solicitud no se pudo crear. Contacte con el Administrador.");
                                        }
                                  });
                    <?php }else { ?> 
                        console.log("Existe");
                    <?php } ?> 
                }  
            }
        </script>
       </div>    
    </div>                         
   </div>
<br>    
<div class="container" id="Requisitos">
    <div id="edituser" class="container"> 
      <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
       <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">¿Quieres editar tus datos personales?</button>
        <div id="demo" class="collapse">   
         <div class="form-group">
           <?= $this->Form->create($usuario, ['url'=>['action'=>'edituser'], 'type'=>'file', 'onSubmit'=>'return checkform()', 'name'=>'edituser']);?>
            <?php
                echo $this->Form->control('Direccion', ['class'=>'form-control', 'id'=>'direccion' ,'empty'=>true]);
                echo "<p id='p_direccion' style='color:red'></p>"; 
                echo $this->Form->control('Localidad', ['class'=>'form-control', 'id'=>'localidad' ,'empty'=>true]);
                echo "<p id='p_localidad' style='color:red'></p>"; 
                echo $this->Form->control('Cp', ['class'=>'form-control', 'id'=>'cp', 'empty'=>true]);
                echo "<p id='p_cp' style='color:red'></p>"; 
                echo $this->Form->control('Telefono', ['class'=>'form-control', 'id'=>'telefono', 'empty'=>true]);
                echo "<p id='p_telefono' style='color:red'></p>"; 
                echo $this->Form->control('Foto', ['class'=>'form-control', 'id'=>'foto', 'empty'=>true]);
                echo "<p id='p_foto' style='color:red'></p>"; 
            ?>
            <button type="submit" class="btn btn-primary btn-md" style="float: right">Editar</button>        
          <?= $this->Form->end() ?>
          <script type="text/javascript">
            function checkform()
            {
                var cp, telefono, foto; 

                cp = document.getElementById("cp").value;
                telefono = document.getElementById("telefono").value;
                foto = document.getElementById("foto").value;

                if (isNaN(cp) || (cp.toString().length<5)) {
                    document.getElementById("p_cp").innerHTML = "Este campo ha de ser de 5 caracteres numéricos";
                    return false;   
                }else {
                    document.getElementById("p_cp").innerHTML = "";
                } 

                if(isNaN(telefono) || (telefono.toString().length<9)){
                    document.getElementById("p_telefono").innerHTML = "Este campo ha de ser de 9 caracteres numéricos";
                    return false;
                }else {
                    document.getElementById("p_telefono").innerHTML = "";
                }

                if(foto!='') {
                    var checkimg = foto.toLowerCase();
                    if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)) {

                        document.getElementById("foto").focus();
                        document.getElementById("p_foto").innerHTML="El archivo ha de ser una imagen."; 
                        return false;
                    }else {
                        document.getElementById("p_foto").innerHTML=""; 
                    }

                    var img = document.getElementById("foto"); 
                    //alert(img.files[0].size);
                    if((img.files[0].size <  5000) || (img.files[0].size >  1048576)) {  
                        document.getElementById("p_foto").innerHTML="El tamaño de la imagen ha de estar comprendido entre 5KB y 1MB";
                        return false;
                    }else{
                        document.getElementById("p_foto").innerHTML="";
                    }

                }

                return true; 
            }
          </script>      
         </div>
        </div>   
       </div>    
      </div>
    </div>
     <br><br>              
      <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
        <h3>Requisitos</h3>
         <?php $ids_requisitos = array(); ?>            
         <?php foreach ($convocatoria->requisitos as $requisito): ?>
         <?php array_push($ids_requisitos,$requisito->id); ?> 
          <div class="list-group">
           <div class="form-group">
            <a class="list-group-item">
              <h3 class="list-group-item-heading"><?= $requisito->Descripcion; ?></h3>
              <form enctype="multipart/form-data" id="formrequisitos_<?=$requisito->id?>" method="post">
              <p class="list-group-item-text"><input type="text" name="Descripcion" id="RequisitoDescripcion_<?=$requisito->id?>" class="form-control" placeholder="Introduzca la descripción del archivo"></p>
              <p id='p_RequisitoDescripcion_<?=$requisito->id?>' style='color:red'></p>
              <p><input type="file" id="RequisitoArchivo_<?=$requisito->id?>"  name="RequisitoArchivo" accept="image/*"></p>
              <p id='p_RequisitoArchivo_<?=$requisito->id?>' style='color:red'></p>
              <p class="text-right"><button type="submit" id="requisito_<?=$requisito->id?>" value="<?= $requisito->id?>" class="btn btn-primary btn-xs">Añadir Evidencia</button></p>
              <script type="text/javascript">
                  $(function(){
                      $("#formrequisitos_<?=$requisito->id?>").on("submit", function(e){
                                                   
                            var RequisitoDescripcion, RequisitoArchivo;

                            rd = document.getElementById("RequisitoDescripcion_<?=$requisito->id?>").value;
                            ra = document.getElementById("RequisitoArchivo_<?=$requisito->id?>").value;

                            if(rd==null || rd=="")
                            {
                                document.getElementById("p_RequisitoDescripcion_<?=$requisito->id?>").innerHTML="Introduzca una descripción del archivo que desea subir."; 
                                return false;
                            }else {
                                document.getElementById("p_RequisitoDescripcion_<?=$requisito->id?>").innerHTML=""; 
                            }

                            if(ra!='') {
                                var checkimg = ra.toLowerCase();
                                if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG|\.pdf|\.PDF)$/)) {

                                    document.getElementById("RequisitoArchivo_<?=$requisito->id?>").focus();
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito->id?>").innerHTML="El archivo ha de ser una imagen o PDF."; 
                                    return false;
                                }else {
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito->id?>").innerHTML=""; 
                                }

                                var img = document.getElementById("RequisitoArchivo_<?=$requisito->id?>"); 
                                //alert(img.files[0].size);
                                if((img.files[0].size <  50000) || (img.files[0].size >  2048576)) {  
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito->id?>").innerHTML="El tamaño de la imagen ha de estar comprendido entre 50KB y 2MB";
                                    return false;
                                }else{
                                    
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito->id?>").innerHTML="";
                                    
                                    e.preventDefault();
                                    var f = $(this);
                                    var formData = new FormData(document.getElementById("formrequisitos_<?=$requisito->id?>"));
                                    formData.append("requisito_id", "<?= $requisito->id ?>")
                                    formData.append("solicitud_id", "<?php if(isset($solicitud)){ echo $solicitud->id; }?>")
                                    //formData.append(f.attr("name"), $(this)[0].files[0]);
                                        $.ajax({
                                            url: "../saverequisitoevidencia",
                                            method: "POST",
                                            dataType: "JSON",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                     processData: false
                                        })
                                            .done(function(json){
                                                if(json.result){
                                                    //alert(json.mensaje);
                                                    location.reload();  
                                                }else {
                                                    alert(json.mensaje);
                                                }
                                            });
                                    
                                return false;    
                                }
                            }else {
                                document.getElementById("p_RequisitoArchivo_<?=$requisito->id?>").innerHTML="Seleccione un archivo.";
                                return false;
                            }
                      });
                  });
              </script>
              <table class="table table-hover">
               <tbody>
                <?php foreach($evidencias as $evidencia): ?>
                <?php if($evidencia['requisitos']['id'] == $requisito['id']) {?>
                 <tr>
                   <td><?= $evidencia['evidencias']['descripcionEvidencia']; //$evidencia['evidencias']['nombre_archivo'].".".$evidencia['evidencias']['extension'] ?></td>
                   <td class="text-right">
                   <button type="button" onclick="deleteEvidenciaRequisito(<?= $evidencia['evidencias']['id']?>)"  class="btn btn-danger btn-xs">Eliminar</button>
                   </td>
                 </tr>
                 <script>
                    function deleteEvidenciaRequisito(evidencia_id) {

                        var url = "../deleteEvidenciaRequisito";

                        $.ajax({
                              url: url,
                              dataType: "JSON",
                              method: "POST",
                              data: { id_evidencia: evidencia_id},
                              success: function(data){

                            }
                            }).done(function(json) {
                                 if(json.result){
                                     //$("#Requisitos").load(" #Requisitos");
                                     location.reload();  
                                 }	
                            });
                    }
                 </script>
                 <?php } ?>
                <?php endforeach; ?>  
               </tbody>
              </table>
             </form>
            </a>
           </div>
          </div>    
        <?php endforeach; ?>  
    </div>  
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 text-right">
      <button type="button" onclick="validateRequisitos()" class="btn btn-primary">Siguiente</button> 
      </div>    
    </div>
    <?php
        $ids_requisitos_evidencias = array();  
        foreach ($evidencias as $evidencia):
            array_push($ids_requisitos_evidencias, $evidencia['requisitos']['id']);
        endforeach;

        $result = true;
        foreach ($ids_requisitos as $id_requisito):
            if(!in_array($id_requisito, $ids_requisitos_evidencias)) {
                $result = false;
                break;
            }
        endforeach;      
    ?>
    <script>
        function validateRequisitos(){ 
            
            <?php if($result) {?>
                var respuesta = confirm("No podrá añadir evidencias a los requisitos una vez que las envíe. ¿Está seguro de que desea enviar sus evidencias?");
                
                if(respuesta == true) {
                    var solicitud_id = <?= $solicitud->id?>;
                    var url = "../validateDivRequisitos";
                    
                    $.ajax({
                          url: url,
                          dataType: "JSON",
                          method: "POST",
                          data: { id_solicitud: solicitud_id},
                          success: function(data){

                        }
                        }).done(function(json) {
                             if(json.result){
                                 location.reload();  
                             }else {
                                 alert("Hubo un fallo validando los requisitos. Por favor contacte con el administrador.")
                             }	
                        }); 
                }
                
            <?php }else { ?>
                alert("Introduzca evidencias en cada uno de los requisitos.")
            <?php } ?>
        }
    </script>         
  </div>
</div>
<br>   
  <div class="container" id="Meritos">
     <br><br>
      <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left"> 
        <h3>Meritos</h3>
         <div id="DivMeritosOutside">
          <div class="list-group" id="DivMeritosInside">
          <?php $ids_meritos = array(); ?>            
          <?php foreach ($convocatoria->meritos as $merito): ?>
          <?php array_push($ids_meritos,$merito->id); ?> 
           <div class="MeritoElement">
            <a class="list-group-item">
             <h3 class="list-group-item-heading"><?=$merito->Descripcion;?></h3>
             <form enctype="multipart/form-data" id="formmeritos_<?=$merito->id?>" method="post">
              <p class="list-group-item-text"><input type="text" name="Descripcion" id="MeritoDescripcion_<?=$merito->id?>" class="form-control" placeholder="Introduzca la descripción del archivo"></p>  
              <p id='p_MeritoDescripcion_<?=$merito->id?>' style='color:red'></p>
              <p><input type="file" id="MeritoArchivo_<?=$merito->id?>" name="MeritoArchivo" accept="image/*"></p>
              <p id='p_MeritoArchivo_<?=$merito->id?>' style='color:red'></p>  
              <p class="text-right"><button type="submit" id="merito_<?=$merito->id?>" value="<?=$merito->id?>" class="btn btn-primary btn-xs">Añadir Evidencia</button></p>
              <script type="text/javascript">
                  $(function(){
                      $("#formmeritos_<?=$merito->id?>").on("submit", function(e){
                                                   
                            var MeritoDescripcion, MeritoArchivo;

                            rd = document.getElementById("MeritoDescripcion_<?=$merito->id?>").value;
                            ra = document.getElementById("MeritoArchivo_<?=$merito->id?>").value;

                            if(rd==null || rd=="")
                            {
                                document.getElementById("p_MeritoDescripcion_<?=$merito->id?>").innerHTML="Introduzca una descripción del archivo que desea subir."; 
                                return false;
                            }else {
                                document.getElementById("p_MeritoDescripcion_<?=$merito->id?>").innerHTML=""; 
                            }

                            if(ra!='') {
                                var checkimg = ra.toLowerCase();
                                if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG|\.pdf|\.PDF)$/)) {

                                    document.getElementById("MeritoArchivo_<?=$merito->id?>").focus();
                                    document.getElementById("p_MeritoArchivo_<?=$merito->id?>").innerHTML="El archivo ha de ser una imagen o PDF."; 
                                    return false;
                                }else {
                                    document.getElementById("p_MeritoArchivo_<?=$merito->id?>").innerHTML=""; 
                                }

                                var img = document.getElementById("MeritoArchivo_<?=$merito->id?>"); 
                                //alert(img.files[0].size);
                                if((img.files[0].size <  50000) || (img.files[0].size >  2048576)) {  
                                    document.getElementById("p_MeritoArchivo_<?=$merito->id?>").innerHTML="El tamaño de la imagen ha de estar comprendido entre 50KB y 2MB";
                                    return false;
                                }else{
                                    
                                    document.getElementById("p_MeritoArchivo_<?=$merito->id?>").innerHTML="";
                                    
                                    e.preventDefault();
                                    var f = $(this);
                                    var formData = new FormData(document.getElementById("formmeritos_<?=$merito->id?>"));
                                    formData.append("merito_id", "<?= $merito->id ?>")
                                    formData.append("solicitud_id", "<?php if(isset($solicitud)){ echo $solicitud->id; }?>")
                                        $.ajax({
                                            url: "../savemeritoevidencia",
                                            method: "POST",
                                            dataType: "JSON",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                     processData: false
                                        })
                                            .done(function(json){
                                                if(json.result){
                                                    //alert(json.mensaje);
                                                    location.reload();  
                                                }else {
                                                    alert(json.mensaje);
                                                }
                                            });
                                    
                                return false;    
                                }
                            }else {
                                document.getElementById("p_MeritoArchivo_<?=$merito->id?>").innerHTML="Seleccione un archivo.";
                                return false;
                            }
                      });
                  });
              </script> 
              <table class="table table-hover">
               <tbody>
               <?php foreach($evidenciasM as $evidenciaM): ?>
                <?php if($evidenciaM['meritos']['id'] == $merito['id']) {?>
                 <tr>
                  <?php $id_shm = $evidenciaM['evidencias']['solicitud_has_meritos_id']?>
                  <?//= $evidenciaM['evidencias']['solicitud_has_meritos_id']?>
                   <td><?= $evidenciaM['evidencias']['descripcionEvidencia']; //$evidenciaM['evidencias']['nombre_archivo'].".".$evidenciaM['evidencias']['extension'] ?></td>
                   <td class="text-right">
                   <button type="button" onclick="deleteEvidenciaRequisito(<?= $evidenciaM['evidencias']['id']?>)"  class="btn btn-danger btn-xs">Eliminar</button>
                   </td>
                 </tr>
                <?php } ?>
               <?php endforeach; ?> 
               </tbody>
              </table>
             </form>
             <!--TENEMOS QUE CREAR PRIMERO LA solicitud_has_merito PARA PODER AÑADIRLE AUTOPUNTUACIÓN -->
             <?php if(($merito->tipos_meritos_id == 2) && isset($id_shm)) {?>
              <label for="MeritoPuntuacion_<?=$merito->id?>">¿Cuantos años de experiencia?</label>
              <input type="text" name="MeritoPuntuacion_<?=$id_shm?>" id="MeritoPuntuacion_<?=$id_shm?>" class="form-control" maxlength="2" placeholder="Introduzca la Puntuación">
              <p id='p_MeritoPuntuacion_<?=$id_shm?>' style='color:red'></p>
              <p class="text-right">
              <button type="button" onclick="addMeritoPuntuacion(<?=$id_shm?>)" class="btn btn-primary  btn-xs">Añadir Puntuación</button>
              </p>                              
             <?php } ?>
             <script>
                 function addMeritoPuntuacion(id) { 
                     var rp = document.getElementById("MeritoPuntuacion_<?=$id_shm?>").value;
                     var url = "../addmeritopuntuacion";
                     
                     if(rp==null || rp=="" || isNaN(rp))
                     {
                         document.getElementById("p_MeritoPuntuacion_<?=$id_shm?>").innerHTML="Introduzca una puntuación numérica de máximo dos digitos."; 
                         return false;
                     }else{
                         document.getElementById("p_MeritoPuntuacion_<?=$id_shm?>").innerHTML=""; 

                         $.ajax({
                               url: url,
                               dataType: "JSON",
                               method: "POST",
                               data: { id: id, puntuacion: rp},
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
             </script>    
            </a>
            <p class="text-right">
             <button type="button" onclick="addMerito(<?= $merito->id?>)" class="btn btn-primary btn-sm">Añadir <?=$merito->Descripcion?></button>
            </p>
           </div>
          <?php endforeach; ?> 
          </div>
          <script>
              function addMerito(id) {
                  var solicitud_id = <?= $solicitud->id?>;
                  var url = "../addsolicitudhasmerito";

                      $.ajax({
                            url: url,
                            dataType: "JSON",
                            method: "POST",
                            data: { merito_id: id, solicitude_id: solicitud_id},
                            success: function(data){

                          }
                          }).done(function(json) {
                               if(json.result){
                                   //$("#Requisitos").load(" #Requisitos");
                                   location.reload();  
                               }else {
                                   alert("Hubo un problema creando el Merito. Contacte con el administrador de la página.");
                               }	
                          }); 
              }
          </script>
        </div>
       </div>    
    </div>
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 text-right">
      <br>
      <button type="button" onclick="validateMeritos()" class="btn btn-primary">Finalizar</button> 
      </div>    
    </div>
    <?php
        $ids_meritos_evidencias = array();  
        foreach ($evidenciasM as $evidenciaM):
            array_push($ids_meritos_evidencias, $evidenciaM['meritos']['id']);
        endforeach;

        $resultM = true;
        foreach ($ids_meritos as $id_merito):
            if(!in_array($id_merito, $ids_meritos_evidencias)) {
                $resultM = false;
                break;
            }
        endforeach;      
    ?>
    <script>
        function validateMeritos(){
            <?php if($resultM) {?>
                var respuesta = confirm("No podrá añadir evidencias a los Meritos una vez que las envíe. ¿Está seguro de que desea enviar sus evidencias?");
                
                if(respuesta == true) {
                    var solicitud_id = <?= $solicitud->id?>;
                    var url = "../validateDivMeritos";
                    
                    $.ajax({
                          url: url,
                          dataType: "JSON",
                          method: "POST",
                          data: { id_solicitud: solicitud_id},
                          success: function(data){

                        }
                        }).done(function(json) {
                             if(json.result){
                                 location.reload();  
                             }else {
                                 alert("Hubo un fallo validando los meritos. Por favor contacte con el administrador.")
                             }	
                        }); 
                }
            <?php }else { ?>
                alert("Introduzca evidencias en cada uno de los méritos.")
            <?php } ?>
        }        
    </script>                  
  </div>
   <div id="Inscrito" class="container">
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-center"><h1><?=$convocatoria->Nombre?></h1></div>   
    </div>
    <br>
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
          <h3>Descripción</h3>
           <pre><?= html_entity_decode($convocatoria->Descripcion) ?>
           </pre>
       </div>    
    </div>    
    <div class="row">
     <div class="col-lg-6 col-lg-offset-3 text-left">    
      <div style="margin-top:20px;">
        <table class="table table-condensed">
         <tbody>
           <tr>
             <td class="text-right">Inicio:</td>
             <td class="text-left"><?=$convocatoria->FechaAltaConvocatoria?></td>
             <td class="text-right">Fin:</td>
             <td class="text-left"><?=$convocatoria->FechaBajaConvocatoria?></td>
           </tr>
         </tbody>
        </table>
     </div>  
     </div>    
    </div>    
    <br>     
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-left">
          <h3>Información de interés</h3>
             <ul class="list-group">
             <?php foreach ($convocatoria->archivossubidos as $archivossubido): ?>
                <li><?= $this->Form->postLink($archivossubido->Descripcion, ['controller' => 'Archivossubidos','action' => 'download','archivo' => $archivossubido->Archivo],['class'=>"list-group-item", 'style'=>"color:blue"]) ?></li>
              <?php endforeach; ?>
             </ul>  
       </div>    
    </div>
<!-- -------------- FUNCION PARA MOSTRAR/ESCONDER Y ACTIVAR/DESCATIVAR LOS BOTONES DE LAS RECLAMACIONES --------------- -->
<?php
 
$fecha_actual = date("d-m-Y H:i:s");
$fecha_inicio = $convocatoria->FechaAltaReclamacion;
$fecha_fin    = $convocatoria->FechaBajaReclamacion;
$fecha_inicio_evaluacion = $convocatoria->FechaAltaReclamacionEvaluacion; 
$fecha_fin_evaluacion    = $convocatoria->FechaBajaReclamacionEvaluacion;        
$fecha_inicio = str_replace('/', '-', $fecha_inicio);
$fecha_fin    = str_replace('/', '-', $fecha_fin);
$fecha_inicio_evaluacion = str_replace('/', '-', $fecha_inicio_evaluacion);
$fecha_fin_evaluacion    = str_replace('/', '-', $fecha_fin_evaluacion);       
$fecha_actual = strtotime($fecha_actual);
$fecha_inicio = strtotime($fecha_inicio);
$fecha_fin    = strtotime($fecha_fin);
$fecha_inicio_evaluacion = strtotime($fecha_inicio_evaluacion);
$fecha_fin_evaluacion    = strtotime($fecha_fin_evaluacion);    

if(($fecha_actual <= $fecha_fin) && ($fecha_actual >= $fecha_inicio))
{
    
    if(!is_null($solicitud->fechaReclamacion)){
        $clase_reclamacion_admision = "btn btn-primary disabled";
    }else {
        $clase_reclamacion_admision = "btn btn-primary"; 
    }

}else{
    
    $clase_reclamacion_admision = "btn btn-primary hidden"; 
}
            
if(($fecha_actual <= $fecha_fin_evaluacion) && ($fecha_actual >= $fecha_inicio_evaluacion)){
    
    if(!is_null($solicitud->fechaReclamacionEvaluacion)){
        $clase_reclamacion_evaluacion= "btn btn-primary disabled";
    }else {
        $clase_reclamacion_evaluacion = "btn btn-primary"; 
    }

}else{
    
    $clase_reclamacion_evaluacion = "btn btn-primary hidden"; 
}       

?>
<!-- ------------------------------------------------- FIN DE FUNCION ------------------------------------------------- -->         
    <div class="col-lg-6 col-lg-offset-3">
        <div class="right">   
            <?= $this->Html->link(__('Reclamar admisión'), ['action' => 'reclamaradmision', $solicitud->id],['class' => $clase_reclamacion_admision, 'id' => 'reclamar_admision', 'confirm' => __('Va a proceder a realizar una reclamación. ¿Está seguro de que desea reclamar esta solicitud?')]) ?>

            <?= $this->Html->link(__('Reclamar evaluacion'), ['action' => 'reclamarevaluacion', $solicitud->id],['class' => $clase_reclamacion_evaluacion, 'id' => 'reclamar_evaluacion', 'confirm' => __('Va a proceder a realizar una reclamación. ¿Está seguro de que desea reclamar esta solicitud?')]) ?>           
           
        </div>    
    </div>                                                                            
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-center"><h2 style='color:red'>Ya se encuentra inscrito en esta convocatoria.</h2></div>   
    </div>
    <?php if(!is_null($solicitud->fechaReclamacion) || !is_null($solicitud->fechaReclamacionEvaluacion)){?>
    <div class="row">
       <div class="col-lg-6 col-lg-offset-3 text-center"><h2 style='color:red'>Su reclamación está en proceso.</h2></div>   
    </div>
    <?php } ?>  
    <br><br>                       
   </div>         
</div>

<script>

$('#Inscrito').hide();

<?php if(!isset($solicitud)) { ?>
    $("#solicitud").show();
    $("#Requisitos").hide();
    $("#Meritos").hide();
<?php } else if(isset($solicitud) && ($solicitud->leido_declaracion_responsable == 1)) { ?>
    $("#solicitud").hide();
    $("#Requisitos").show();
    $("#Meritos").hide();
<?php } ?>
    
<?php if(isset($solicitud) && ($solicitud->valido_evidencias_requisitos == 1)) { ?> 
    $("#solicitud").hide();
    $("#Requisitos").hide();
    $("#Meritos").show();
<?php } ?>
    
<?php if(isset($solicitud) && ($solicitud->valido_evidencias_meritos == 1)) { ?>
    $("#solicitud").hide();
    $("#Requisitos").hide();
    $("#Meritos").hide();
    $('#Inscrito').show();
<?php } ?>
    
</script>                                                                             