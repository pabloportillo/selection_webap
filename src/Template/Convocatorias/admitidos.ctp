<style>
    .pointer {cursor: pointer;}
</style>

<?php 
    if(!$convocatoria->ListadoAdmitidos) { 
        $var = "<em style='color:red'> no publicada </em>";
    } else {
        $var = "<em style='color:green'> publicada </em>";
    }
?>

<div class="admitidos view large-9 medium-8 columns content">
    <h1><?= __('Lista de admitidos  '.$var) ?> </h1>
    
	<div class="panel-group" id="accordion" role="tablist">
			<div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-filter" ></i> Filtros <i class="fa fa-chevron-down pull-right"></i></a></h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body" id="divFiltro">   
	<form>
		<div class="form-group row">
			<div class="col-xs-12">
				<label for="termino">Término a buscar</label>
				<input type="text" class="form-control" name="termino" value="<?php if(isset($_GET['termino'])) echo $_GET['termino'];?>">
				<p style='color:grey'><font size="2" >Nombre, Apellido, DNI o Email</font></p>
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
<!---------------------------------TABLA OCULTA DE ADMITIDOS----------------------------------------------------->      
      <table class="table table-hover table-bordered grid2" cellpadding="0" cellspacing="0" id='tabla' style="display:none">
        <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Teléfono</th>
            </tr>
        </thead>        
        <tbody>    
        <?php foreach ($admitidos as $admitido): ?>
            <tr style="cursor: pointer;">
                <td><?= $admitido['usuarios']['Nombre']?></td>
                <td><?= $admitido['usuarios']['Apellidos']?></td >
                <td><?= $admitido['usuarios']['Telefono']?></td>
            </tr>
        <?php endforeach; ?>       
        </tbody> 
      </table>
<!-----------------------------------TABLA OCULTA DE NO ADMITIDOS----------------------------------------------->
      <table class="table table-hover table-bordered grid2" cellpadding="0" cellspacing="0" id='tabla2' style="display:none">
        <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Motivos de Exclusión</th>
            </tr>
        </thead>        
        <tbody>    
        <?php foreach ($noadmitidos as $noadmitido): ?>
              <?php 

                  $motivos = "";
                  foreach ($exclusionmotivos as $exclusionmotivo):

                    if($noadmitido['id'] == $exclusionmotivo['id']) {
                        $motivos .= $exclusionmotivo['requisitos']['motivo_exclusion'].". ";
                    }

                  endforeach;
              ?>           
            <tr style="cursor: pointer;">
                <td><?= $noadmitido['usuarios']['Nombre']?></td>
                <td><?= $noadmitido['usuarios']['Apellidos']?></td>
                <td><?= $noadmitido['usuarios']['Telefono']?></td>
                <td><?= $motivos?></td>
            </tr>
        <?php endforeach; ?>       
        </tbody> 
      </table> 
<!------------------------------------------------------------------------------------------------------------------->    
      <table class="table table-hover table-bordered grid2" cellpadding="0" cellspacing="0" id='tabla_filtrada'>
        <thead>
          <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
              </tr>
          </thead>        
          <tbody>
         <?php if(sizeof($solicitudes) !=0) { ?>       
          <?php foreach ($solicitudes as $solicitud): ?>
            <tr style="cursor: pointer;" onclick="window.location='/solicitudes/ver/<?=$solicitud['id']?>'">
                <td><?= $solicitud['usuario']['Nombre']?></td>
                <td><?= $solicitud['usuario']['Apellidos']?></td >
                <td><?= $solicitud['usuario']['Telefono']?></td>
            </tr>
          <?php endforeach; ?>       
          </tbody> 
          </table>
          <?php if(!$convocatoria->ListadoAdmitidos) { ?>
          <div id="publicar">
              <button style="float: right" onclick="publicarlista(<?=$id?>)" type="button" class="btn btn-primary">Publicar</button>              
          </div>
          <?php } else {?>
          <div id="descargar">
            <input type="button" name="btnExportar" class="btn btn-primary" id="btnExportar" value="Exportar Admitidos" 
            onclick="ExportToExcel(jQuery('#tabla').prop('outerHTML'))" style="float: right" />
            <input type="button" name="btnExportar" class="btn btn-primary" id="btnExportar" value="Exportar No Admitidos" 
            onclick="ExportToExcel2(jQuery('#tabla2').prop('outerHTML'))" style="float: right" />                            
            <!--<?//= $this->Html->link('Exportar', ['controller' => 'Convocatorias', 'action' => 'exportadmitidos', '_ext' => 'csv', $id], ['class' => 'btn btn-primary', 'style' => 'float: right']) ?>-->   
          </div>
          <?php }?>              
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
<script>
    function publicarlista(id){
        var respuesta = confirm("¿Está seguro de que desea publicar la lista de admitidos?");        
        
        if(respuesta == true){
            var url = "../publicaradmitidos";

            $.ajax({
                  url: url,
                  dataType: "JSON",
                  method: "POST",
                  data: { id_convocatoria: id},
                  success: function(data){
                }
                }).done(function(json) {
                     if(json.result){
                         location.reload();  
                     }else {
                         alert("Hubo un fallo publicando la lista de admitidos. Por favor contacte con el administrador.")
                     }	
                });             
        }
    }
</script>

<script>
//FUNCION PARA EXPORTAR LA TABLA DE ADMITIDOS A EXCEL    
function ExportToExcel(htmlExport) {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    
    //other browser not tested on IE 11
    // If Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
        jQuery('body').append(" <iframe id=\"iframeExport\" style=\"display:none\"></iframe>");
        iframeExport.document.open("txt/html", "replace");
        iframeExport.document.write(htmlExport);
        iframeExport.document.close();
        iframeExport.focus();
        sa = iframeExport.document.execCommand("SaveAs", true, "List.xls");
    }
    else {      
        var link = document.createElement('a');
        
        document.body.appendChild(link); // Firefox requires the link to be in the body
        link.download = "Lista Admitidos.xls";
        link.href = 'data:application/vnd.ms-excel,' + escape(htmlExport);
        link.click();
        document.body.removeChild(link);
    }
}
//FUNCION PARA EXPORTAR LA TABLA DE NO ADMITIDOS A EXCEL    
function ExportToExcel2(htmlExport) {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    
    //other browser not tested on IE 11
    // If Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
        jQuery('body').append(" <iframe id=\"iframeExport\" style=\"display:none\"></iframe>");
        iframeExport.document.open("txt/html", "replace");
        iframeExport.document.write(htmlExport);
        iframeExport.document.close();
        iframeExport.focus();
        sa = iframeExport.document.execCommand("SaveAs", true, "List.xls");
    }
    else {      
        var link = document.createElement('a');
        
        document.body.appendChild(link); // Firefox requires the link to be in the body
        link.download = "Lista de No Admitidos.xls";
        link.href = 'data:application/vnd.ms-excel,' + escape(htmlExport);
        link.click();
        document.body.removeChild(link);
    }
}       
    
</script>

