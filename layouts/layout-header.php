<?php
session_start();
$ssid = session_id();

require_once('db/db.php');

if(isset($_POST['close'])) {
    session_unset();
    header('Location: .');
} 

if(isset($_SESSION['id'])) {

    $id=$_SESSION['id'];

    $sql = "SELECT * FROM user_info WHERE user_id=$id";
    $a1 = $db->query($sql);
    $consulta=$a1->fetch_object();

    $uType = $consulta->user_type;

    $sql3 = "UPDATE cart SET user_id='$id' WHERE ssid='$ssid'";
    $db->query($sql3);

    

    $sql1 = "SELECT COUNT(p_id) as 'numero_de_articulos' FROM cart WHERE ssid='$ssid' OR user_id='$id'";
    $b1 = $db->query($sql1);
    $consultaB1 = $b1->fetch_object();

    $numDeArt = $consultaB1->numero_de_articulos;

} else {

    $sql1 = "SELECT COUNT(p_id) as 'numero_de_articulos' FROM cart WHERE ssid='$ssid'";
    $b1 = $db->query($sql1);
    $consultaB1 = $b1->fetch_object();
    
    $numDeArt = $consultaB1->numero_de_articulos;

}

?>

<header>
    <nav class="centrado">
        <section id="menu1">
            <ul>
                <li>
                    <a class="btn btn-success btn-sm ml-3" href="cart.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-light"><?= $numDeArt ?></span>
                    </a>
                </li>
                <?php if(isset($id)): ?>
                <li><a href="profile.php"><?= $consulta->first_name ?></a></li>
                <li><form action="." method="POST"><button class="btn btn-outline-danger" name="close"><i class="fas fa-sign-out-alt"></i></button></form></li>
                <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
                <?php endif ?>
            </ul>
        </section>
        <section id="menu2">
            <img src="img/website/logo.png" alt="">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="products.php">Productos</a></li>
                <li><a href="about.php">Sobre nosotros</a></li>
                <li><a href="contact.php">Contacto</a></li>
            </ul>
        </section>
    </nav>
</header>