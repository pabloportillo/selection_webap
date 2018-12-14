<!DOCTYPE html>

<?php
if (isset($_GET['success_edit'])) {
    ?>
<div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Se han guardado los cambios
</div>
    <?php
}
?>

<h1>Bienvenido <?= $this->request->getSession()->read('Auth.User.Nombre')." ".$this->request->getSession()->read('Auth.User.Apellidos') ?> </h1>