<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
  <script type="text/javascript">
    /*
     * PORTILLO:
     *
     * Es el script que va a realizar una serie de cambios dinamicos en añadir usuario. 
     *
     */  
   
		$(document).ready(function() {
			
        if ("<?= $this->request->getSession()->read('Auth.User.Perfile_id') ?>" == 2) {
            $("#empresa").remove();
        }
		  var id = $("#perfile-id").find(':selected').val();   

          if( id == 1 )
            {
                $("label[for='empresa-id']").css("display", "none"); 
                $('#empresa-id').css("display", "none");
				$('#empresa-id').prop('required', false);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none"); 
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 2 )
            {
                $("label[for='empresa-id']").css("display", "block");  
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 3 )
            {
                $("label[for='empresa-id']").css("display", "block");  
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none");
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 4 )
            {
                $("label[for='empresa-id']").css("display", "block"); 
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
				
            }else if ( id == 5 )
            {
                $("label[for='empresa-id']").css("display", "block"); 
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "block");   
                $('#dni').css("display", "block");
				$("#dni").prop('required', true);
                $("label[for='direccion']").css("display", "block");  
                $('#direccion').css("display", "block");
				$('#direccion').prop('required', true);
				$("label[for='localidad']").css("display", "block");  
                $('#localidad').css("display", "block");
				$('#localidad').prop('required', true);
				$("label[for='cp']").css("display", "block");  
                $('#cp').css("display", "block");
				$('#cp').prop('required', true);
				$("label[for='foto']").css("display", "block");  
                $('#foto').css("display", "block");
				//$('#foto').prop('required', true);
            }else 
			{
				// Oculta el label Empresa.  
				$("label[for='empresa-id']").css("display", "none"); 
				// Oculta el select Empresa.  
				$('#empresa-id').css("display", "none"); 

				// Oculta el label DNI
				$("label[for='dni']").css("display", "none");    
				// Oculta el imput DNI
				$('#dni').css("display", "none");   

				// Oculta el label Direccion
				$("label[for='direccion']").css("display", "none");  
				// Oculta el input Direccion
				$('#direccion').css("display", "none");
				
				// Oculta el label localidad
				$("label[for='localidad']").css("display", "none");  
				// Oculta el input localidad
				$('#localidad').css("display", "none"); 
				
				// Oculta el label cp
				$("label[for='cp']").css("display", "none");  
				// Oculta el input cp
				$('#cp').css("display", "none"); 
				
				// Oculta el label foto
				$("label[for='foto']").css("display", "none");  
				// Oculta el input foto
                $('#foto').css("display", "none");

			}
			
			//Para poner el label del DNI en negrita.
			$('#dni').parent().attr('class', 'input text required');
			//Para poner el label del Empresa en negrita.
			$('#empresa-id').parent().attr('class', 'input select required')
		});
	   
      $(function(){           
          
        $('#perfile-id').on('change', function() {
        var id = $("#perfile-id").find(':selected').val();   
            
          if( id == 1 )
            {
                $("label[for='empresa-id']").css("display", "none"); 
                $('#empresa-id').css("display", "none");
				$('#empresa-id').prop('required', false);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 2 )
            {
                $("label[for='empresa-id']").css("display", "block");  
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 3 )
            {
                $("label[for='empresa-id']").css("display", "block");  
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none");
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 4 )
            {
                $("label[for='empresa-id']").css("display", "block"); 
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "none");   
                $('#dni').css("display", "none"); 
				$("#dni").prop('required', false);
                $("label[for='direccion']").css("display", "none");  
                $('#direccion').css("display", "none");
				$("label[for='localidad']").css("display", "none");  
				$('#localidad').css("display", "none"); 
				$("label[for='cp']").css("display", "none");
				$('#cp').css("display", "none"); 
				$("label[for='foto']").css("display", "none");
				$('#foto').css("display", "none");
            }else if ( id == 5 )
            {
                $("label[for='empresa-id']").css("display", "block"); 
                $('#empresa-id').css("display", "block");
				$('#empresa-id').prop('required', true);
                $("label[for='dni']").css("display", "block");   
                $('#dni').css("display", "block");
				$("#dni").prop('required', true);
				$('#dni').parent().attr('class', 'input text required');
                $("label[for='direccion']").css("display", "block");  
                $('#direccion').css("display", "block");
				$('#direccion').prop('required', true);
				$("label[for='localidad']").css("display", "block");  
                $('#localidad').css("display", "block");
				$('#localidad').prop('required', true);
				$("label[for='cp']").css("display", "block");  
                $('#cp').css("display", "block");
				$('#cp').prop('required', true);
				$("label[for='foto']").css("display", "block");  
                $('#foto').css("display", "block");
				//$('#foto').prop('required', true);
            }
        });     
          
        }); 
        
        $(window).load(function(){
        });
    </script>
        
</head>
<body>
<?php
if (isset($fail_edit)) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?= $fail_edit ?>
</div>
    <?php
}
?>
<br>
<?php

if (isset($fail_edit)) {
    ?>
<div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?= $fail_edit; ?>
</div>
    <?php
}
?>
<div class="usuarios form large-9 medium-8 columns content">
   <!-- array('type'=>'file') PORQUE SE VAN A SUBIR ARCHIVOS (FOTO) -->
    <?= $this->Form->create($usuario, array('type'=>'file')) ?>
    <fieldset>
        <legend><?= __('Editar Usuario') ?></legend>
        <?php
        ?>
        <div class="form-group row">
            <div class="col-xs-6">
        <?php
            echo $this->Form->control('Nombre', ['class' => 'form-control', 'label' => 'Nombre *']);
            ?>
        </div>
        <div class="col-xs-6">
            <?php
            echo $this->Form->control('Apellidos', ['class' => 'form-control', 'label' => 'Apellidos *']);
            ?>
        </div>
    </div>
    <div class="form-group row">
            <div class="col-xs-6">
            <?php
            echo $this->Form->control('Telefono', ['type' => 'tel','class' => 'form-control', 'label' => 'Telefono *']);
            ?>
       		</div>
            <div class="col-xs-6">
            <?php
			echo $this->Form->control('Email', ['type' => 'email','class' => 'form-control', 'label' => 'Email *']);
            ?>
        </div>
    </div>
    <div class="form-group row">
            <div class="col-xs-6">
    <?php
		echo $this->Form->control('Contraseña', ['type' => 'password', 'required' => true,'class' => 'form-control', 'label' => 'Contraseña *']);
            ?>
        </div>
        <div class="col-xs-6">
            <?php
			if(isset($confirm_pass)){
			     echo $this->Form->control('Contraseña_match', ['type' => 'password', 'value' => $confirm_pass , 'label' => 'Confirma Contraseña *', 'required' => true,'class' => 'form-control']); 
			}else{
			     echo $this->Form->control('Contraseña_match', ['type' => 'password', 'value' => $usuario->Contraseña , 'label' => 'Confirma Contraseña *', 'required' => true,'class' => 'form-control']); 
			}

            if (isset($dont_match)) {
                echo "<font color='red'>" . $dont_match . "</font>";
            }
            ?>
        </div>
    </div>
    <div class="form-group row">
		<div class="col-xs-12" id="edit_perfil">
		<?php
			echo $this->Form->control('Perfile_id', ['options' => $perfiles, 'required' => true,'class' => 'form-control', 'label' => 'Perfil *']);
		?>
		</div>
	</div>
<div class="form-group row">
            <div class="form-group row">
            <div class="col-xs-12" id="edit_empresa">
            <?php		
            echo $this->Form->control('Empresa_id', ['options' => $empresas, 'empty' => true,'class' => 'form-control', 'label' => 'Empresa *']);
            ?>
        </div>
    </div>
            <div class="col-xs-6">
			<?php
            echo $this->Form->control('Dni', ['class' => 'form-control', 'label' => 'Dni *']);//, ['required' => true]);
            ?>
        </div>
        <div class="col-xs-6">
            <?php
            echo $this->Form->control('Direccion', ['class' => 'form-control', 'label' => 'Dirección *']);
            ?>
        </div>
</div>
   	<div class="form-group row">
        <div class="col-xs-6">
		<?php
            echo $this->Form->control('Localidad', ['class' => 'form-control', 'label' => 'Localidad *']); 
        ?>
        </div>
        <div class="col-xs-6">
        <?php
            echo $this->Form->control('Cp', ['class' => 'form-control', 'label' => 'Código Postal *']);
        ?>
        </div>
    </div>
   	<div class="form-group row">
        <div class="col-xs-6">
			<?php
				echo $this->Form->control('Foto', ['class' => 'form-control', 'label' => 'Foto *']);
			?>
        </div>
    </div>  
    <div id="edit_activo" class="form-group row">
            <div class="col-xs-12" id="activo">
            <br>
            <b>Activo</b>
   			<?php
            	echo $this->Form->control('Activo',['templates' => ['inputContainer' => '{{content}}'], 'label' => false]);
        	?>
    </div>
</div>  
    </fieldset>
  <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
<?= $this->Form->end() ?>
</div>

</body>
</html>