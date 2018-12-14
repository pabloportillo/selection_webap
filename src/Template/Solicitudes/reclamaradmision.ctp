 <div class="container" id="Requisitos">
     <br><br>                  
      <div class="row">
      <div id="descripcion" class="col-lg-6 col-lg-offset-3 text-left">
        <div class="form-group">
          <label for="comment">Argumente el motivo de su reclamación:</label>
          <textarea id="Descripcion" name="Descripcion" class="form-control" rows="5" maxlength="3550"></textarea>
          <p id='p_Descripcion' style='color:red'></p>
        </div> 
        <div class="right">
          <button type="button" onclick="añadirdescripcion()" class="btn btn-primary" style="float: right;">Siguiente</button>   
        </div>         
      </div>       
       <div id="requisito" class="col-lg-6 col-lg-offset-3 text-left">
        <h3>Requisitos</h3>
         <?php $ids_requisitos = array(); ?>            
         <?php foreach ($solicitud_has_requisitos as $requisito): ?>
          <div class="list-group">
           <div class="form-group">
            <a class="list-group-item">
              <h3 class="list-group-item-heading"><?= $requisito['requisitos']['Descripcion']; ?></h3>
              <form enctype="multipart/form-data" id="formrequisitos_<?=$requisito['requisitos']['id']?>" method="post">
              <p class="list-group-item-text"><input type="text" name="Descripcion" id="RequisitoDescripcion_<?=$requisito['requisitos']['id']?>" class="form-control" placeholder="Introduzca la descripción del archivo"></p>
              <p id='p_RequisitoDescripcion_<?=$requisito['requisitos']['id']?>' style='color:red'></p>
              <p><input type="file" id="RequisitoArchivo_<?=$requisito['requisitos']['id']?>"  name="RequisitoArchivo" accept="image/*"></p>
              <p id='p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>' style='color:red'></p>
              <p class="text-right"><button type="submit" id="requisito_<?=$requisito['requisitos']['id']?>" value="<?= $requisito['requisitos']['id']?>" class="btn btn-primary btn-xs">Añadir Evidencia</button></p>
              <script type="text/javascript">
                  $(function(){
                      $("#formrequisitos_<?=$requisito['requisitos']['id']?>").on("submit", function(e){
                                                   
                            var RequisitoDescripcion, RequisitoArchivo;

                            rd = document.getElementById("RequisitoDescripcion_<?=$requisito['requisitos']['id']?>").value;
                            ra = document.getElementById("RequisitoArchivo_<?=$requisito['requisitos']['id']?>").value;

                            if(rd==null || rd=="")
                            {
                                document.getElementById("p_RequisitoDescripcion_<?=$requisito['requisitos']['id']?>").innerHTML="Introduzca una descripción del archivo que desea subir."; 
                                return false;
                            }else {
                                document.getElementById("p_RequisitoDescripcion_<?=$requisito['requisitos']['id']?>").innerHTML=""; 
                            }

                            if(ra!='') {
                                var checkimg = ra.toLowerCase();
                                if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG|\.pdf|\.PDF)$/)) {

                                    document.getElementById("RequisitoArchivo_<?=$requisito['requisitos']['id']?>").focus();
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>").innerHTML="El archivo ha de ser una imagen o PDF."; 
                                    return false;
                                }else {
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>").innerHTML=""; 
                                }

                                var img = document.getElementById("RequisitoArchivo_<?=$requisito['requisitos']['id']?>"); 
                                //alert(img.files[0].size);
                                if((img.files[0].size <  50000) || (img.files[0].size >  2048576)) {  
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>").innerHTML="El tamaño de la imagen ha de estar comprendido entre 50KB y 2MB";
                                    return false;
                                }else{
                                    
                                    document.getElementById("p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>").innerHTML="";
                                    
                                    e.preventDefault();
                                    var f = $(this);
                                    var formData = new FormData(document.getElementById("formrequisitos_<?=$requisito['requisitos']['id']?>"));
                                    formData.append("requisito_id", "<?= $requisito['requisitos']['id'] ?>")
                                    formData.append("solicitud_id", "<?php if(isset($solicitud)){ echo $solicitud->id; }?>")
                                    formData.append("reclamacion_id", "<?= $id_reclamacion ?>")
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
                                document.getElementById("p_RequisitoArchivo_<?=$requisito['requisitos']['id']?>").innerHTML="Seleccione un archivo.";
                                return false;
                            }
                      });
                  });
              </script>
              <table class="table table-hover">
               <tbody>
                <?php foreach($evidencias as $evidencia): ?>
                <?php if($evidencia['solicitud_has_requisitos']['requisito_id'] == $requisito['requisitos']['id']) {?>
                 <tr>
                   <td><?= $evidencia['evidencias']['descripcionEvidencia']; //$evidencia['evidencias']['nombre_archivo'].".".$evidencia['evidencias']['extension'] ?></td>
                   <td class="text-right">
                   <?php if($evidencia['evidencias']['extension'] == 'pdf') {?>
                       <button type="button" onclick="window.open('data:application/pdf;base64,<?= $evidencia['evidencias']['evidencia']?>')"  class="btn btn-info btn-xs">Mostrar</button>
                   <?php }else { ?>
                       <button type="button" onclick="window.open('data:image/jpg;base64,<?= $evidencia['evidencias']['evidencia']?>')"  class="btn btn-info btn-xs">Mostrar</button>
                   <?php } ?>
                   <?php if($evidencia['evidencias']['reclamacion_id'] != null) {?>
                        <button type="button" onclick="deleteEvidenciaRequisito(<?= $evidencia['evidencias']['id']?>)"  class="btn btn-danger btn-xs">Eliminar</button>
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
            </a>
           </div>
          </div>    
        <?php endforeach; ?>  
    <div class="right">
      <button type="button" onclick="TerminarReclamacionAdmision()" class="btn btn-primary" style="float: right;">Finalizar</button> 
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
        
        function TerminarReclamacionAdmision(){ 

            var respuesta = confirm("No podrá volver a reclamar su admisión una vez finalice con el proceso. ¿Desea finalizar la reclamación?");

            if(respuesta == true) {
                var solicitud_id = <?= $solicitud->id?>;
                var url = "../terminarReclamacionAdmision";

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
</div>
<?php
    
    $descripcion = false;
    foreach($solicitud->reclamaciones as $reclamacion) :      
                    
        if(($reclamacion->tipo == "admision") && (!is_null($reclamacion->descripcion)))
        {
            $descripcion = true;
        }         
    endforeach;                     
?>    

<script>
<?php if($descripcion == false){ ?>
    $("#descripcion").show();
    $("#requisito").hide();
<?php } else {?>    
    $("#descripcion").hide();
    $("#requisito").show();
<?php }?>  
</script>        
