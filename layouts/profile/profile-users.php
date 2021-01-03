<?php

if(!isset($_SESSION['id'])) header('Location: .');



?>

<section id="profile">

<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center">
      <div class="media-body">
        <h4 class="m-0"><?= $consulta->first_name ." ". $consulta->last_name ?></h4>
        <p class="font-weight-light text-muted mb-0"><?= $consulta->user_type ?></p>
      </div>
    </div>
  </div>

  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="profile.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Perfil
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Preferencias
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Pedidos
            </a>
    </li>
  </ul>
</div>

<div class="page-content" id="content">
</div>


</section>