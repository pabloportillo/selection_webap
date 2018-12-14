<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
if (isset($not_match)) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Las contraseñas no coinciden
    </div>
    <?php
}

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
<h2>Cambiar contraseña</h2>
<div class="row">
    <div id="divpnl" class="col-md-12">
        <section id="loginForm">

<form method="POST">
	<h4>Especifique la nueva contraseña</h4>       
    <div id="content">
	   
        <div class="container">
            <p class="text-center logo"></p>
            <div class="panel panel-default form-signin">
                <div class="panel-body">
                	<div class="loginMargin">
                        <label for="password">Contraseña</label>
						<input class="form-control" type="password" name="password" required>
                        <label for="confirmpassword">Confirmar contraseña</label>
                        <input class="form-control" type="password" name="confirmpassword" required>
                        <span style="color: red" id="error"></span>
					</div>
					
					<button type="submit" style="float:left" class="btn-block btn-primary btn no-margin"><i class="fas fa-key"></i> Cambiar contraseña</button>
					</form>
					</div>
            </div>
		</div>

    </div>

</div>
  
</div>

</div>