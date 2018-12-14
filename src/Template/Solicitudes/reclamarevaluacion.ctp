<div class="container" id="Meritos">   
     <br><br>   
      <div class="row">
  <div id="descripcion" class="col-lg-6 col-lg-offset-3 text-left">
    <div class="form-group">
      <label for="comment">Argumente el motivo de su reclamación:</label>
      <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5" maxlength="3550"></textarea>
      <p id='p_Descripcion' style='color:red'></p>
    </div>
        <div class="row">
          <button type="button" onclick="añadirdescripcion()" class="btn btn-primary" style="float: right;">Siguiente</button>  
        </div>       
  </div>        
       <div id="merito" class="col-lg-6 col-lg-offset-3 text-left"> 
        <h3>Meritos</h3>
         <div id="DivMeritosOutside">
          <div class="list-group" id="DivMeritosInside">
          <?php $ids_meritos = array(); ?>            
          <?php foreach ($solicitud_has_meritos as $merito): ?>
           <div class="MeritoElement">
            <a class="list-group-item">
             <h3 class="list-group-item-heading"><?=$merito['meritos']['descripcion'];?></h3>
             <form enctype="multipart/form-data" id="formmeritos_<?=$merito['meritos']['id']?>" method="post">
              <p class="list-group-item-text"><input type="text" name="Descripcion" id="MeritoDescripcion_<?=$merito['meritos']['id']?>" class="form-control" placeholder="Introduzca la descripción del archivo"></p>  
              <p id='p_MeritoDescripcion_<?=$merito['meritos']['id']?>' style='color:red'></p>
              <p><input type="file" id="MeritoArchivo_<?=$merito['meritos']['id']?>" name="MeritoArchivo" accept="image/*"></p>
              <p id='p_MeritoArchivo_<?=$merito['meritos']['id']?>' style='color:red'></p>  
              <p class="text-right"><button type="submit" id="merito_<?=$merito['meritos']['id']?>" value="<?=$merito['meritos']['id']?>" class="btn btn-primary btn-xs">Añadir Evidencia</button></p>
              <script type="text/javascript">
                  $(function(){
                      $("#formmeritos_<?=$merito['meritos']['id']?>").on("submit", function(e){
                                                   
                            var MeritoDescripcion, MeritoArchivo;

                            rd = document.getElementById("MeritoDescripcion_<?=$merito['meritos']['id']?>").value;
                            ra = document.getElementById("MeritoArchivo_<?=$merito['meritos']['id']?>").value;

                            if(rd==null || rd=="")
                            {
                                document.getElementById("p_MeritoDescripcion_<?=$merito['meritos']['id']?>").innerHTML="Introduzca una descripción del archivo que desea subir."; 
                                return false;
                            }else {
                                document.getElementById("p_MeritoDescripcion_<?=$merito['meritos']['id']?>").innerHTML=""; 
                            }

                            if(ra!='') {
                                var checkimg = ra.toLowerCase();
                                if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG|\.pdf|\.PDF)$/)) {

                                    document.getElementById("MeritoArchivo_<?=$merito['meritos']['id']?>").focus();
                                    document.getElementById("p_MeritoArchivo_<?=$merito['meritos']['id']?>").innerHTML="El archivo ha de ser una imagen o PDF."; 
                                    return false;
                                }else {
                                    document.getElementById("p_MeritoArchivo_<?=$merito['meritos']['id']?>").innerHTML=""; 
                                }

                                var img = document.getElementById("MeritoArchivo_<?=$merito['meritos']['id']?>"); 
                                //alert(img.files[0].size);
                                if((img.files[0].size <  50000) || (img.files[0].size >  2048576)) {  
                                    document.getElementById("p_MeritoArchivo_<?=$merito['meritos']['id']?>").innerHTML="El tamaño de la imagen ha de estar comprendido entre 50KB y 2MB";
                                    return false;
                                }else{
                                    
                                    document.getElementById("p_MeritoArchivo_<?=$merito['meritos']['id']?>").innerHTML="";
                                    
                                    e.preventDefault();
                                    var f = $(this);
                                    var formData = new FormData(document.getElementById("formmeritos_<?=$merito['meritos']['id']?>"));
                                    formData.append("merito_id", "<?= $merito['meritos']['id'] ?>")
                                    formData.append("solicitud_id", "<?php if(isset($solicitud)){ echo $solicitud->id; }?>")
                                    formData.append("reclamacion_id", "<?= $id_reclamacion ?>")
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
                                document.getElementById("p_MeritoArchivo_<?=$merito['meritos']['id']?>").innerHTML="Seleccione un archivo.";
                                return false;
                            }
                      });
                  });
              </script> 
              <table class="table table-hover">
               <tbody>
               <?php foreach($evidencias as $evidenciaM): ?>
                <?php if($evidenciaM['solicitud_has_meritos']['merito_id'] == $merito['meritos']['id']) {?>
                 <tr>
                  <?php $id_shm = $evidenciaM['evidencias']['solicitud_has_meritos_id']?>
                  <?//= $evidenciaM['evidencias']['solicitud_has_meritos_id']?>
                   <td><?= $evidenciaM['evidencias']['descripcionEvidencia']; //$evidenciaM['evidencias']['nombre_archivo'].".".$evidenciaM['evidencias']['extension'] ?></td>
                   <td class="text-right">
                   <?php if($evidenciaM['evidencias']['extension'] == 'pdf') {?>
                       <button type="button" onclick="window.open('data:application/pdf;base64,<?= $evidenciaM['evidencias']['evidencia']?>')"  class="btn btn-info btn-xs">Mostrar</button>
                   <?php }else { ?>
                       <button type="button" onclick="window.open('data:image/jpg;base64,<?= $evidenciaM['evidencias']['evidencia']?>')"  class="btn btn-info btn-xs">Mostrar</button>
                   <?php } ?>
                   <?php if($evidenciaM['evidencias']['reclamacion_id'] != null) {?>
                        <button type="button" onclick="deleteEvidenciaRequisito(<?= $evidenciaM['evidencias']['id']?>)"  class="btn btn-danger btn-xs">Eliminar</button>
                   <?php }?>                     
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
             <!--TENEMOS QUE CREAR PRIMERO LA solicitud_has_merito PARA PODER AÑADIRLE AUTOPUNTUACIÓN -->
             <?php if(($merito['meritos']['tipos_meritos_id'] == 2) && isset($id_shm)) {?>
              <label for="MeritoPuntuacion_<?=$merito['meritos']['id']?>">¿Cuantos años de experiencia?</label>
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
             <button type="button" onclick="addMerito(<?= $merito['meritos']['id']?>)" class="btn btn-primary btn-sm">Añadir <?=$merito['meritos']['descripcion']?></button>
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
        <div class="row">
          <button type="button" onclick="TerminarReclamacionEvaluacion()" class="btn btn-primary" style="float: right;">Finalizar</button>  
        </div>        
       </div>    
    </div>    
    <script>
        
        function añadirdescripcion(){
            var descripcion = document.getElementById("Descripcion").value;

            if(descripcion==null || descripcion=="")
            {
                document.getElementById("p_Descripcion").innerHTML="Este campo no puede estar vacío."; 
                return false;
            }else {
                document.getElementById("p_Descripcion").innerHTML=""; 
            }
            
            var r = confirm("¿Desea continuar con el proceso de reclamación?");
            
            if(r == true){
                var reclamacion_id = <?= $id_reclamacion?>;
                var url = "../añadirdescripcion";

                $.ajax({
                      url: url,
                      dataType: "JSON",
                      method: "POST",
                      data: {id_reclamacion: reclamacion_id, descripcion: descripcion},
                      success: function(data){

                    }
                    }).done(function(json) {
                         if(json.result){
                             location.reload();  
                         }else {
                             alert("Hubo un fallo realizando la reclamación de admisión. Por favor contacte con el administrador.")
                         }	
                    }); 
            }
            
        }
        
        function TerminarReclamacionEvaluacion(){           

            var respuesta = confirm("No podrá volver a reclamar su evaluacion una vez finalice con el proceso. ¿Desea finalizar la reclamación?");

            if(respuesta == true) {
                var solicitud_id = <?= $solicitud->id?>;
                var url = "../terminarReclamacionEvaluacion";

                $.ajax({
                      url: url,
                      dataType: "JSON",
                      method: "POST",
                      data: { id_solicitud: solicitud_id},
                      success: function(data){

                    }
                    }).done(function(json) {
                         if(json.result){
                             //location.reload();  
                             window.location.href = "/solicitudes/add/<?=$solicitud->convocatoria_id?>"; 
                         }else {
                             alert("Hubo un fallo realizando la reclamación de admisión. Por favor contacte con el administrador.")
                         }	
                    }); 
            }
        }        
    </script>                  
  </div>
  <?php
    
    $descripcion = false;
    foreach($solicitud->reclamaciones as $reclamacion) :      
                    
        if(($reclamacion->tipo == "evaluacion") && (!is_null($reclamacion->descripcion)))
        {
            $descripcion = true;
        }         
    endforeach;                     
?>    

<script>
<?php if($descripcion == false){ ?>
    $("#descripcion").show();
    $("#merito").hide();
<?php } else {?>    
    $("#descripcion").hide();
    $("#merito").show();
<?php }?>  
</script> 