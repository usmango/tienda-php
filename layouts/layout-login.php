<?php

require_once('db/db.php');


?>

<section id="login">

  <form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="login">Iniciar sesión</button>
  </form>

</section>