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
      <a href="profile.php" class="nav-link text-dark font-italic">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Perfil
            </a>
    </li>
    <li class="nav-item">
      <a href="?page=preferences" class="nav-link text-dark font-italic">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Preferencias
            </a>
    </li>
    <li class="nav-item">
      <a href="?page=orders" class="nav-link text-dark font-italic">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Pedido
            </a>
    </li>
    <li class="nav-item">
      <a href="?page=products" class="nav-link text-dark font-italic">
            <i class="fas fa-boxes mr-3 text-primary fa-fw"></i>
                Productos
            </a>
    </li>
    <li class="nav-item">
      <a href="?page=users" class="nav-link text-dark font-italic">
                <i class="fas fa-users mr-3 text-primary fa-fw"></i>
                Usuarios
            </a>
    </li>
  </ul>
</div>

<div class="page-content" id="content">

<?php 
if(isset($_GET['addProduct'])) {

  require('profile/profile-products-add.php'); 

} else if(isset($_GET['page'])) {

  if($_GET['page'] == 'preferences') require('profile/profile-preferences.php'); 
  if($_GET['page'] == 'products') require('profile/profile-products.php'); 
  if($_GET['page'] == 'users') require('profile/profile-users.php'); 
  if($_GET['page'] == 'addUser') require('profile/profile-users-add.php');
  if($_GET['page'] == 'addProduct') require('profile/profile-products-add.php');
  if($_GET['page'] == 'orders') require('profile/profile-orders.php');

}  else {
  if(isset($_GET['edit'])) require('profile/profile-products-edit.php');
  if(isset($_GET['editUser'])) require('profile/profile-users-edit.php');
}

?>

</div>


</section>