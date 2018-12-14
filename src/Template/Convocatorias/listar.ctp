<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Convocatoria[]|\Cake\Collection\CollectionInterface $convocatorias
 */
?>
<style>
	
	.inactive {
    	background-color: #fcacac !important;
	}

	#convocatorias_table > tbody > tr:hover{
    background-color: #e4e4e4;
	}		
</style>

<?php
if (isset($_GET['success_add'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha añadido la convocatoria correctamente.
</div>
    <?php
}

if (isset($_GET['success_edit'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      La convocatoria se editó correctamente.
</div>
    <?php
}

if (isset($_GET['success_delete'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se ha eliminado la convocatoria correctamente.
</div>
    <?php
}

if (isset($_GET['fail_delete'])) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Los datos no se pudieron eliminar. Por favor, intentelo de nuevo.
</div>
    <?php
}
?>

<div class="convocatorias index large-9 medium-8 columns content">
    <h1><?= __('Convocatorias') ?></h1>
    <?= $this->Html->link(__('Añadir Convocatoria'), ['action' => 'add'],['class' => 'btn btn-primary', 'id' => 'add_convocatoria']) ?>
    
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
								</div>
						</div>
					  <button style="float: right" type="submit" class="btn btn-default">Buscar</button>
					</form>               
					 </div>
				</div>
			</div>
	</div>      

    <table class="table table-striped table-bordered grid2" cellpadding="0" cellspacing="0" id='convocatorias_table'>
        <thead>
            <tr>
                <!--<th scope="col"><//?= $this->Paginator->sort('id') ?></th> -->
                <th class="fill"><?= $this->Paginator->sort('Nombre') ?></th>
                <th class="fill" scope="col"><?= $this->Paginator->sort('Alta Convocatoria') ?></th>
                <th class="fill" scope="col"><?= $this->Paginator->sort('Baja Convocatoria') ?></th>
                <!--<th scope="col" class="actions"><?//= __('Acciones') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($convocatorias as $convocatoria): ?>
            <tr style="cursor: pointer;" onclick="window.location='/solicitudes/add/<?=$convocatoria->id?>'">
                <!--<td><//?= $this->Number->format($convocatoria->id) ?></td>-->
                <td><?= h($convocatoria->Nombre) ?></td>
                <td><?= h($convocatoria->FechaAltaConvocatoria) ?></td>
                <td><?= h($convocatoria->FechaBajaConvocatoria) ?></td>
                <!--
                <td class="actions">
                    <?//= $this->Html->link(__('Ver'), ['action' => 'view', $convocatoria->id]) ?>
                    <?//= $this->Html->link(__('Editar'), ['action' => 'edit', $convocatoria->id], ['class' => 'edit_convocatoria']) ?>
                    <?//= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $convocatoria->id], ['class' => 'delete_convocatoria'], ['confirm' => __('Esta accion es irreversible y eliminará del sistema categorias, requisitos, méritos y archivos subidos pertenecientes a esta convocatoria. ¿Está seguro de que desea eliminar la convocatoria "{0}"?', $convocatoria->Nombre)]) ?>
                </td>
                -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<?php    
	$count = $this->request->getParam('paging.Convocatorias.count');

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