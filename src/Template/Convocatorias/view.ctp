<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Convocatoria $convocatoria
 */
?>

<style>

	th {
		width: 15%;
	}

	.right {
    float:right;
	}
	
	.ajustado {
    	width: 15%;;
	}

	tr.sortable>td {
		cursor: pointer;
	}
	
	#informacion_table > tbody > tr:hover{
    background-color: #e4e4e4;
	}
</style>

<?php
if (isset($_GET['success_add_file'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El archivo se ha subido correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_add_exclusionMotivo'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El motivo de exclusión se ha guardado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_delete_exclusionMotivo'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El motivo de exclusión se ha borrado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_add_requisito'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El requisito se ha guardado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_add_merito'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El mérito se ha guardado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_add_category'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    La categoría se ha guardado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_delete_file'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El archivo se ha eliminado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_delete_category'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    La categoría se ha eliminado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_delete_requisito'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El requisito se ha eliminado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_delete_merito'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El merito se ha eliminado correctamente.
</div>
    <?php
}
?>

<?php
if (isset($_GET['success_edit_file']) || isset($_GET['success_edit_category']) || isset($_GET['success_edit_exclusionMotivo'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se han guardado los cambios
</div>
    <?php
}
?>

<div class="convocatorias view large-9 medium-8 columns content">
    <h1>Información sobre esta convocatoria</h1>
    <table id='informacion' class="table table-striped table-bordered grid2 vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($convocatoria->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($convocatoria->usuario->Email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Creacion') ?></th>
            <td><?= h($convocatoria->FechaCreacion) ?></td>   
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Alta Convocatoria') ?></th>
            <td><?= h($convocatoria->FechaAltaConvocatoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Baja Convocatoria') ?></th>
            <td><?= h($convocatoria->FechaBajaConvocatoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Admitidos') ?></th>
            <td><?= h($convocatoria->FechaAdmitidos) ?></td>
        </tr>         
        <tr>
            <th scope="row"><?= __('Fecha Evaluacion') ?></th>
            <td><?= h($convocatoria->FechaEvaluacion) ?></td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Fecha Alta Reclamacion Admitidos') ?></th>
            <td><?= h($convocatoria->FechaAltaReclamacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Baja Reclamacion Admitidos') ?></th>
            <td><?= h($convocatoria->FechaBajaReclamacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Alta Reclamacion Evaluación') ?></th>
            <td><?= h($convocatoria->FechaAltaReclamacionEvaluacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Baja Reclamacion Evaluación') ?></th>
            <td><?= h($convocatoria->FechaBajaReclamacionEvaluacion) ?></td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Visible') ?></th>
            <td><?= $convocatoria->Visible ? __('Si') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= html_entity_decode($convocatoria->Descripcion) ?></td> 
        </tr>
    </table>    
    <div class="right">
        <button type="button" onclick="window.location='/solicitudes/listar/<?=$convocatoria->id?>'" class="btn btn-primary">Solicitudes</button>

        <button type="button" onclick="window.location='/convocatorias/admitidos/<?=$convocatoria->id?>'" class="btn btn-primary">Admitidos</button>
                       
        <button type="button" onclick="window.location='/convocatorias/evaluados/<?=$convocatoria->id?>'" class="btn btn-primary">Evaluados</button>
                                                                                
        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $convocatoria->id],['class' => 'btn btn-primary', 'id' => 'edit_convocatoria']) ?>
        
        <?= $this->Html->link(__('Duplicar'), ['action' => 'duplicar', $convocatoria->id],['class' => 'btn btn-primary', 'id' => 'duplicar_convocatoria']) ?>        
        
        <!--BOTON BORRAR CONVOCATORIA COMENTADO: No se borraran las convocatorias -->
        <?php echo $this->Form->postLink(__('Borrar'), ['action' => 'delete', $convocatoria->id], ['confirm' => __('Esta accion es irreversible y eliminará del sistema categorias, requisitos, méritos y archivos subidos pertenecientes a esta convocatoria. ¿Está seguro de que desea eliminar la convocatoria "{0}"?', $convocatoria->Nombre),'class' => 'btn btn-danger', 'id' => 'delete_convocatoria']) ?>
  </div>

<!--
---------------------------------------- ARCHIVOS SUBIDOS ---------------------------------------- 
-->           
  <br><br>
   <hr>
    <h2>Archivos</h2>
    <table class="table table-striped table-bordered grid2" id="informacion_table">
      <tr>
    <th>Archivos</th>
      <th class="fill">Descripción</th>
      <!--<th  class="acciones">Acciones</th>-->
    </tr>
    <?php
    foreach ($archivossubidos as $as) { ?>
	 
	 <tr class="sortable" onclick="window.location='/archivossubidos/view/<?=$as->id?>'">	
	<?php
      echo "<td>".$as['Archivo']."</td>";
      echo "<td>".$as['Descripcion']."</td>";
	  /*								   
      echo "<td class='acciones'>"
		  .$this->Html->link(__('Ver'), ['controller' => 'Archivossubidos', 'action' => 'view',$as['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Html->link(__('Editar'), ['controller' => 'Archivossubidos', 'action' => 'edit',$as['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Form->postLink(__('Eliminar'), ['controller' => 'Archivossubidos', 'action' => 'delete', $as['id'],'convocatoria_id' => $convocatoria->id], ['confirm' => __('Estas seguro de que quiere eliminar el archivo {0}?', $as['Archivo'])])
		  ." ".
		  $this->Form->postLink('Descargar', ['controller' => 'Archivossubidos','action' => 'download','archivo' => $as->Archivo])
		  ."</td>";
		*/
      echo "</tr>";	
    }
    ?>
  </table>
  <div id="archivos">
    <?= $this->Html->link(__('Añadir Archivo'), ['controller' => 'Archivossubidos','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre],['class' => 'btn btn-primary right']) ?>
  </div>
  
<!--
---------------------------------------- REQUISITOS ----------------------------------------
--> 
       
  <br><br>
  <hr>
  <h2>Requisitos</h2>

  <table class="table table-striped table-bordered grid2" id="informacion_table">
    <tr>
      <th class="fill">Descripción</th>
      <th class="fill">Motivo de exclusión</th>
      <!--<th  class="acciones">Acciones</th>-->
    </tr>
    <?php
    foreach ($requisitos as $r) { ?>
      <tr class="sortable" onclick="window.location='/requisitos/view/<?=$r->id?>'">	
    <?php  
      echo "<td>".$r['Descripcion']."</td>";
      echo "<td>".$r['motivo_exclusion']."</td>";                                 
      /*								 
      echo "<td class='acciones'>"
		  .$this->Html->link(__('Ver'), ['controller' => 'Requisitos', 'action' => 'view',$r['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Html->link(__('Editar'), ['controller' => 'Requisitos', 'action' => 'edit',$r['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Form->postLink(__('Eliminar'), ['controller' => 'Requisitos', 'action' => 'delete', $r['id'],'convocatoria_id' => $convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar el requisito {0}?.', $r['Descripcion'])])."</td>";  
	   */  
      echo "</tr>";
    }
    ?>
  </table>
  <div id="requisitos">
	<?= $this->Html->link(__('Añadir Requisito'), ['controller' => 'Requisitos','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre],['class' => 'btn btn-primary right']) ?>
</div>

<!--
---------------------------------------- CATEGORIAS ---------------------------------------- 
--> 
   
  <br><br>
  <hr>
  <h2>Categorías</h2>

  <table class="table table-striped table-bordered grid2" id="informacion_table">
    <tr>
      <th class="fill">Descripción</th>
      <th>Puntuación máxima</th>
      <!--<th  class="acciones">Acciones</th>-->
    </tr>
    <?php
    foreach ($categorias as $c) { ?>
      <tr class="sortable" onclick="window.location='/categorias/view/<?=$c->id?>'">	
    <?php  
      echo "<td>".$c['Descripcion']."</td>";
      echo "<td>".$c['PuntuacionMax']."</td>";
      /*								 
      echo "<td class='acciones'>"
		  .$this->Html->link(__('Ver'), ['controller' => 'Categorias', 'action' => 'view',$c['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Html->link(__('Editar'), ['controller' => 'Categorias', 'action' => 'edit',$c['id'],'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre])
		  ." ".
		  $this->Form->postLink(__('Eliminar'), ['controller' => 'Categorias', 'action' => 'delete', $c['id'],'convocatoria_id' => $convocatoria->id], ['confirm' => __('¿Estas seguro de que quiere eliminar la categoría {0} y todos sus méritos relaccionados?, esta acción no es reversible.', $c['Descripcion'])])."</td>";  
	   */	  
      echo "</tr>";
    }
    ?>
  </table>
  <div id="categorias">
	<?= $this->Html->link(__('Añadir Categoria'), ['controller' => 'Categorias','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre],['class' => 'btn btn-primary right']) ?>
</div>

<!--
------------------------------------- MERITO: FORMACION --------------------------------------
-->   	  
  <br><br>
  <hr>
  <h2>Formación</h2>
  <table class="table table-striped table-bordered grid2" id="informacion_table">
    <tr>
      <th class="fill">Descripción</th>
      <th> Categoría</th>
      <th> Puntuación</th>
      <!--<th  class="acciones">Acciones</th>-->
    </tr>
    <?php
    foreach ($meritos as $m) {?>
     <?php if($m['tipos_meritos_id'] == 1) { ?>
      <tr class="sortable" onclick="window.location='/meritos/view/<?=$m->id?>'">	    
        <td><?= $m['Descripcion'] ?></td>
        <td><?= $m['categorias']['Descripcion'] ?></td>
        <td><?= $m['Puntuacion'] ?></td>
      </tr>
    <?php }} ?>
  </table>
  <div id="meritos">
	<?= $this->Html->link(__('Añadir Formación'), ['controller' => 'Meritos','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre, 'tipo' => 1],['class' => 'btn btn-primary right']) ?>
  </div>
  
<!--
------------------------------------- MERITO: EXPERIENCIA --------------------------------------
-->   	  
  <br><br>
  <hr>
  <h2>Experiencia</h2>
  <table class="table table-striped table-bordered grid2" id="informacion_table">
    <tr>
      <th class="fill">Descripción</th>
      <th> Categoría</th>
      <th> Puntuación</th>
      <!--<th  class="acciones">Acciones</th>-->
    </tr>
    <?php
    foreach ($meritos as $m) {?>
     <?php if($m['tipos_meritos_id'] == 2) { ?>
      <tr class="sortable" onclick="window.location='/meritos/view/<?=$m->id?>'">	    
        <td><?= $m['Descripcion'] ?></td>
        <td><?= $m['categorias']['Descripcion'] ?></td>
        <td><?= $m['Puntuacion'] ?></td>
      </tr>
    <?php }} ?>
  </table>
  <div id="meritos">
	<?= $this->Html->link(__('Añadir Experiencia'), ['controller' => 'Meritos','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre,'tipo' => 2], ['class' => 'btn btn-primary right']) ?>
  </div>
  
<!--
---------------------------------------- MOTIVOS DE EXCLUSION ---------------------------------------- 
-->
<?php /*    	  
  <br><br>
  <hr>
  <h2>Motivos de Exclusión</h2>
  <table class="table table-striped table-bordered grid2" id="informacion_table">
    <tr>
      <th class="fill">Descripción</th>
    </tr>
    <?php
    foreach ($exclusionMotivos as $motivo) {?>
      <tr class="sortable" onclick="window.location='/exclusionMotivos/view/<?=$motivo->id?>'">	
		<?php  
		  echo "<td>".$motivo['descripcion']."</td>";
		  echo "</tr>";
		}
		?>
  </table>
  <div id="motivos">
	<?= $this->Html->link(__('Añadir Motivo Exclusion'), ['controller' => 'ExclusionMotivos','action' => 'add', 'id' => $convocatoria->id,'nombre' => $convocatoria->Nombre],['class' => 'btn btn-primary right']) ?>
  </div>
*/?>                       
<!--
------------------------------------ SOLICITUDES DE LA CONVOCATORIA -----------------------------------
-->   	  
  <br><br>
  <h2>Solicitudes</h2>
  <table class="table table-striped table-bordered grid2" id="informacion_table">
      <tr>
      <!-- <tr class="sortable" onclick="window.location='/solicitudes/view/<?php// echo $solicitude->id; ?>'">	-->
        <td>No Evaluados</td>
        <td><?=$noevaluados->count()?></td>
      </tr>
      <tr>
      <!-- <tr class="sortable" onclick="window.location='/solicitudes/view/<?php// echo $solicitude->id; ?>'">	-->
        <td>Evaluados</td>
        <td><?=$evaluados->count()?></td>
      </tr>	
      <tr>
      <!-- <tr class="sortable" onclick="window.location='/solicitudes/view/<?php// echo $solicitude->id; ?>'">	-->
        <td>Aceptados</td>
        <td><?=$aceptados->count()?></td>
      </tr>	
  </table>