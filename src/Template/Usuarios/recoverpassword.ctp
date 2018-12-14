<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

?>

<script>
    $(document).ready(function () {
        <?php
        if (isset($not_found)) { ?>
            $("#error").html("No existe un usuario con este email");
        <?php } ?>
    });
</script>
<div class="users form">
<h2>Recuperación de contraseña</h2>
<div class="row">
    <div id="divpnl" class="col-md-12">
        <section id="loginForm">

<form action="recoverpassword" method="POST">
	<h4>Especifique su email.</h4>       
    <div id="content">
	   
        <div class="container">
            <p class="text-center logo"></p>
            <div class="panel panel-default form-signin">
                <div class="panel-body">
                	<div class="loginMargin">
						<input class="form-control" type="email" name="email" placeholder="Email" required>
                        <span style="color: red" id="error"></span>
					</div>
					
					<button type="submit" style="float:left" class="btn-block btn-primary btn no-margin"><i class="fas fa-envelope "></i> Enviar correo con la nueva contraseña</button>
					</form>
					</div>
            </div>
		</div>
          
    </div>

</div>
  
</div>

</div>