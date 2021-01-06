<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');

?>

<section id="profile" class="p-5">

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Mantenimiento!</h4>
  <p>Estamos llevando a cabo una serie de mejoras aquí. Vuelve mas tarde para verlas.</p>
</div>

</section>