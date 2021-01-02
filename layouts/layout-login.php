<?php

if(isset($_POST['login'])) {

  if(!empty($_POST['email'])) $email = $_POST['email']; else $errores['email'] = 'E-Mail vacio';
  if(!empty($_POST['password'])) $password = $_POST['password']; else $errores['password'] = 'Password vacio';

  if(!isset($errores)) {

    $sql = "SELECT user_id, email, password FROM user_info WHERE email='$email'";
    $a1 = $db->query($sql);
    $consulta=$a1->fetch_object();

    if(mysqli_num_rows($a1) > 0){

      if($password==$consulta->password) {
        $_SESSION['id'] = $consulta->user_id;
        header('Location: profile.php');
      }

    } else {
      $errores['existe']='Ese usuario no existe';
    }

  }

}

?>

<section id="login">

  <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Iniciar sesión</button>
  </form>

<ul>
  <?php 
  
  if(isset($errores)){
    foreach($errores as $value) {
    
  ?>   

  <li class="alert alert-danger"><?= $value; ?></li>
  
  <?php 
    }
  }
  
  ?>
</ul>

</section>