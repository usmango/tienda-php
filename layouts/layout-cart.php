<?php

$sqlCart = "SELECT id, p_id, products.product_title, products.product_image, products.product_price, qty
            FROM cart INNER JOIN products ON p_id=product_id
            WHERE user_id='$id'";
$d1 = $db->query($sqlCart);
$consultaArticulosCart = $d1->fetch_object();

$sqlCartTotal = "SELECT SUM(product_price) as total
            FROM cart INNER JOIN products ON p_id=product_id
            WHERE user_id='$id'";
$e1 = $db->query($sqlCartTotal);
$consultaTotalCart = $e1->fetch_object();

if(isset($_POST['remove'])) {
  $idcarta = $_POST['remove'];
  $sqlRemove = "DELETE FROM cart WHERE id='$idcarta'";
  $db->query($sqlRemove);
  header('Location: cart.php');
}

if(isset($_POST['update'])) {
  $idcarta = $_POST['update'];
  $cantidad = $_POST['qty'];
  $sqlUpdate = "UPDATE cart SET qty='$cantidad' WHERE id='$idcarta'";
  $db->query($sqlUpdate);
  header('Location: cart.php');
}

?>

<section id="cart">
<?php while($consultaArticulosCart!=null): ?>
<article>

  <img src="img/product_images/<?= $consultaArticulosCart->product_image ?>" alt="">
  <p><?= $consultaArticulosCart->product_title ?></p>

  <p><?= $consultaArticulosCart->product_price ?> €</p>

  <form action="cart.php" method="POST">
    <input type="number" name="qty" min="1" value="<?= $consultaArticulosCart->qty ?>" class="form-control mr-1">
    <button value="<?= $consultaArticulosCart->id ?>" name="update" class="btn btn-success mr-5">Actualizar</button>
    <button value="<?= $consultaArticulosCart->id ?>" name="remove" class="btn btn-danger">Eliminar</button>
  </form>

</article>
<?php 
$consultaArticulosCart=$d1->fetch_object();
endwhile
?>
<h4>Total: <?= $consultaTotalCart->total ?> €</h4>
<button class="btn btn-primary btn-lg btn-block mt-5">PAGAR</button>

</section>