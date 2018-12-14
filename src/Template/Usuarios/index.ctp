<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuarios
 */
?>
<style>
tr.sortable>td {
    cursor: pointer;
}
	
#usuarios_table > tbody > tr:hover{
    background-color: #e4e4e4;
}	
</style>

<?php 
if (isset($_GET['mensaje_bienvenida'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      ¡Bienvenido!.
</div>
    <?php
}
if (isset($_GET['success_add'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El usuario se guardó correctamente.
</div>
    <?php
}

if (isset($_GET['success_delete'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El usuario se eliminó correctamente.
</div>
    <?php
}

if (isset($_GET['success_edit'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El usuario se ha editado correctamente.
</div>
    <?php
}

if (isset($_GET['fail_delete'])) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    El usuario no se pudo eliminar, por favor, inténtelo de nuevo.
</div>
    <?php
}

?>

<div class="usuarios index large-9 medium-8 columns content">
    <h1><?= __('Usuarios') ?></h1>     
    <div class="right">
            <?= $this->Html->link(__('Añadir Usuario'), ['action' => 'add'],['class' => 'btn btn-primary']) ?>            
    </div>   
                
	<div class="panel-group" id="accordion" role="tablist">
			<div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-filter" ></i> Filtros <i class="fa fa-chevron-down pull-right"></i></a></h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body" id="divFiltro">   
	<form>
		<div class="form-group row">
			<div class="col-xs-6">
				<label for="termino">Término a buscar</label>
				<input type="text" class="form-control" name="termino" value="<?php if(isset($_GET['termino'])) echo $_GET['termino'];?>">
				<p style='color:grey'><font size="2" >Nombre, Apellido, o Email</font></p>
			</div>
			<div class="col-xs-6">    
				<label for="estado">Estado</label>
				<select name="estado" class="form-control">
					<option value="Todos"<?php if(isset($_GET['estado']) && $_GET['estado'] =='Todos') echo 'selected="selected" ';?>>Todos</option>
					<option value="Activo"<?php if(isset($_GET['estado']) && $_GET['estado']=='Activo') echo 'selected="selected" ';?>>Activo</option>
					<option value="Inactivo"<?php if(isset($_GET['estado']) && $_GET['estado']=='Inactivo') echo 'selected="selected" ';?>>Inactivo</option>
				</select>				
			</div>	
					
		</div>
					
	  <button style="float: right" type="submit" class="btn btn-primary">Buscar</button>
	</form>               
	 </div>
			</div>
		</div>
	</div>                      
      
    <table style="border-spacing: 0 1em;" class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id="usuarios_table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Perfile_id', array('label' => 'Perfil')) ?></th>
                <!-- <th scope="col" class="actions"><?//= __('Acciones') ?></th>--> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>        
			<tr class="sortable" onclick="window.location='/usuarios/view/<?=$usuario->id?>'">
                <td><?= h($usuario->Nombre) ?></td>
                <td><?= h($usuario->Email) ?></td>
				<td><?= h($usuario->perfile->Nombre) ?></td>

                <!-- 
                  * Para poner el número de telefono en formato xxx xxx xxx 
                -->                
                <!-- <td><?//= $this->Number->format($usuario->Telefono , ['locale' => 'fr_FR']) ?></td> -->  

                <!-- 
                * PORTILLO
                *
                * Mostramos el nombre de la empresa (en vez del id) y hacemos link a la empresa en cuestión.
                *
                *
                -->
                <!-- <td><?//= $usuario->has('empresa') ? $this->Html->link($usuario->empresa->NombreEmpresa, ['controller' => 'Empresas', 'action' => 'view', $usuario->empresa->id]) : '' ?></td>-->
                <!-- 
                * PORTILLO
                *
                * Muestra si el usuario está activado. Si / No
                *
                * 
                <td class="actions">
                    <?//= $this->Html->link(__('Ver'), ['action' => 'view', $usuario->id]) ?>
                    <?//= $this->Html->link(__('Editar'), ['action' => 'edit', $usuario->id]) ?>
                    <?//= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $usuario->id], ['confirm' => __('Esta accion es irreversible y eliminará del sistema las solicitudes creadas por este usuario. ¿Está seguro de que desea eliminar al usuario "{0}"?', $usuario->Nombre . " " . $usuario->Apellidos)]) ?> 
                </td> -->


            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php 

	$count = $this->request->getParam('paging.Usuarios.count');

	if($count>20)
	{ 
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