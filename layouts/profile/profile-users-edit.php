<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');
if($uType=="normal") header('Location: .');

$iduser = $_GET['editUser'];

$sql = "SELECT * from user_info WHERE user_id='$iduser'";
$a1 = $db->query($sql);
$consultaUsuarioEditar = $a1->fetch_object();


if(isset($_POST['updateUser'])) {
  $pass=true;

  if(!empty($_POST['name'])) $name=$_POST['name']; else $name=$consultaUsuarioEditar->first_name;
  if(!empty($_POST['surname'])) $surname=$_POST['surname']; else $surname=$consultaUsuarioEditar->last_name;
  if(!empty($_POST['email'])) $email=$_POST['email']; else $email=$consultaUsuarioEditar->email;
  if(!empty($_POST['password'])) $password=password_hash($_POST['password'], PASSWORD_DEFAULT); else $pass=false;
  if(!empty($_POST['userType'])) $userType=$_POST['userType']; else $userType=$consultaUsuarioEditar->user_type;
  if(!empty($_POST['status'])) $status=$_POST['status']; else $status=$consultaUsuarioEditar->status;

  if($pass) {
    $sqlUpdate = "UPDATE user_info SET first_name='$name', last_name='$surname', email='$email', password='$password', user_type='$userType', status='$status' 
    WHERE user_id='$iduser'";
    $db->query($sqlUpdate);
  } else {
    $sqlUpdate = "UPDATE user_info SET first_name='$name', last_name='$surname', email='$email', user_type='$userType', status='$status' 
    WHERE user_id='$iduser'";
    $db->query($sqlUpdate);
  }
  header('Location: profile.php?page=users');
}



?>


<section id="profile">


<form action="<?= $url ?>" method="POST" enctype="multipart/form-data" class="p-5">

<label for="name">Nombre del usuario</label>
<input type="text" name="name" class="form-control" value="<?= $consultaUsuarioEditar->first_name ?>">

<label for="surname">Apellido del usuario</label>
<input type="text" name="surname" class="form-control" value="<?= $consultaUsuarioEditar->last_name ?>">

<label for="email">E-Mail del usuario</label>
<input type="email" name="email" class="form-control" value="<?= $consultaUsuarioEditar->email ?>">

<label for="password">Contraseña del usuario</label>
<input type="text" name="password" class="form-control" value="">

<label for="email">Tipo de usuario: </label>

<div class="form-check form-check-inline">
    <input type="radio" name="userType" <?php if ($consultaUsuarioEditar->user_type == "normal") echo "checked";?> value="normal" class="form-check-input">
  <label class="form-check-label" for="inlineRadio1">Normal</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" name="userType" <?php if ($consultaUsuarioEditar->user_type == "admin") echo "checked";?> value="admin" class="form-check-input">
  <label class="form-check-label" for="inlineRadio2">Administrador</label>
</div>

<br>

<label for="email">Status de usuario: </label>

<div class="form-check form-check-inline">
    <input type="radio" name="status" <?php if ($consultaUsuarioEditar->status == "active") echo "checked";?> value="active" class="form-check-input">      
  <label class="form-check-label" for="inlineRadio1">Activado</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" name="status" <?php if ($consultaUsuarioEditar->status == "disabled") echo "checked";?> value="disabled" class="form-check-input">
  <label class="form-check-label" for="inlineRadio2">Desactivado</label>
</div>

<input type="submit" name="updateUser" value="Actualizar usuario" class="form-control btn btn-success mt-2">

</form>


</section>