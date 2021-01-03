<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');

if(isset($_POST['save'])) {
  $pass=false;

  if(empty($_POST['name'])) $name = $consulta->first_name; else $name = $_POST['name'];
  if(empty($_POST['lastname'])) $lastname = $consulta->last_name; else $lastname = $_POST['lastname'];
  if(empty($_POST['email'])) $email = $consulta->email; else $email = $_POST['email'];
  if(!empty($_POST['oldpassword']) && !empty($_POST['newpassword'])) $pass=true;

  if($pass==true) {

    if($consulta->password==$_POST['oldpassword']) $password = $_POST['newpassword'];

    $sqlProfileUpdate = "UPDATE user_info SET first_name='$name', last_name='$lastname', email='$email', password='$password' WHERE user_id='$id'";
    $db->query($sqlProfileUpdate);

  } else {
    $sqlProfileUpdate = "UPDATE user_info SET first_name='$name', last_name='$lastname', email='$email' WHERE user_id='$id'";
    $db->query($sqlProfileUpdate);
  }


}



?>

<section id="profile">

  <form action="<?= $url ?>" method="post" class="p-5">
  
  <label for="name">Nombre</label>
  <input type="text" name="name" class="form-control">
  
  <label for="lastname">Apellido</label>
  <input type="text" name="lastname" class="form-control">
  
  <label for="email">E-Mail</label>
  <input type="email" name="email" class="form-control">
  
  <label for="oldpassword">Contraseña Actual</label>
  <input type="password" name="oldpassword" class="form-control">
  
  <label for="newpassword">Contraseña Nueva</label>
  <input type="password" name="newpassword" class="form-control">

  <input type="submit" value="Guardar" name="save" class="form-control btn btn-success mt-2">

  </form>

</section>