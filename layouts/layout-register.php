<?php

$registrado = false;

if (isset($_POST['register'])) {

	if (!empty($_POST['name'])) $name = $_POST['name'];
	else $errores['name'] = 'Falta nombre';
	if (!empty($_POST['surname'])) $surname = $_POST['surname'];
	else $errores['surname'] = 'Falta apellido';
	if (!empty($_POST['email'])) $email = $_POST['email'];
	else $errores['email'] = 'Falta email';
	if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
		if ($_POST['password1'] == $_POST['password2']){
			 $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
		} else {
			$errores['password'] = 'Contraseñas diferentes';
		}
	} else {
		$errores['password'] = 'Falta contraseña';
	}

	if(!isset($errores)) {

		$sql1 = "SELECT user_id, email, password FROM user_info WHERE email='$email'";
		$a1 = $db->query($sql1);
		$consulta=$a1->fetch_object();

		if(mysqli_num_rows($a1) == 0){
			$sql2 = "INSERT INTO user_info (first_name, last_name, email, password)
					values('$name', '$surname', '$email', '$password')";
			
			$db->query($sql2);
		} else {
			
			$errores['existe'] = 'Este usuario ya esta registrado';
		}

	};

}

?>

<section id="register">

	<?php if( isset($_POST['register']) && !isset($errores) ): ?>

	<h1>Te has registrado correctamente</h1>
	<p>Haz click aquí para iniciar sesión</p>
	<a href="login.php" class="btn btn-primary">Iniciar sesión</a>
	
	<?php else: ?>

	<form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<h1 class="h3 mb-3 font-weight-normal">Regístrate</h1>
		<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required autofocus>
		<br>
		<input type="text" id="surname" name="surname" class="form-control" placeholder="Apellidos" required autofocus>
		<br>
		<input type="email" id="email" name="email" class="form-control" placeholder="E-Mail" required autofocus>
		<br>
		<input type="password" id="password1" name="password1" class="form-control" placeholder="Contraseña" required>
		<input type="password" id="password2" name="password2" class="form-control" placeholder="Repetir contraseña" required>
		<br>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Registrarse</button>
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

	<?php endif ?>

</section>