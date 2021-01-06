<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');
if($uType=="normal") header('Location: .');

if(isset($_POST['addUser'])) {
  
  if(!empty($_POST['name'])) $name=$_POST['name'];
  if(!empty($_POST['surname'])) $surname=$_POST['surname'];
  if(!empty($_POST['email'])) $email=$_POST['email'];
  if(!empty($_POST['password'])) $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
  if(!empty($_POST['userType'])) $userType=$_POST['userType'];
  if(!empty($_POST['status'])) $status=$_POST['status'];
  
  $sql2 = "INSERT INTO user_info (first_name, last_name, email, password, user_type, status)
					values('$name', '$surname', '$email', '$password', '$userType', '$status')";
			
  $db->query($sql2);
  header('Location: profile.php?page=users');
}


?>

<section id="profile">

<form action="<?= $url ?>" method="POST" enctype="multipart/form-data" class="p-5">

<label for="name">Nombre del usuario</label>
<input type="text" name="name" class="form-control" value="" required>

<label for="surname">Apellido del usuario</label>
<input type="text" name="surname" class="form-control" value="" required>

<label for="email">E-Mail del usuario</label>
<input type="email" name="email" class="form-control" value="" required>

<label for="password">Contraseña del usuario</label>
<input type="text" name="password" class="form-control" value="" required>

<label for="email">Tipo de usuario: </label>

<div class="form-check form-check-inline">
    <input type="radio" name="userType" checked value="normal" class="form-check-input">
  <label class="form-check-label" for="inlineRadio1">Normal</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" name="userType" value="admin" class="form-check-input">
  <label class="form-check-label" for="inlineRadio2">Administrador</label>
</div>

<br>

<label for="email">Status de usuario: </label>

<div class="form-check form-check-inline">
    <input type="radio" name="status" checked value="active" class="form-check-input">      
  <label class="form-check-label" for="inlineRadio1">Activado</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" name="status" value="disabled" class="form-check-input">
  <label class="form-check-label" for="inlineRadio2">Desactivado</label>
</div>

<input type="submit" name="addUser" value="Añadir usuario" class="form-control btn btn-success mt-2">

</form>

</section>