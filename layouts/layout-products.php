<?php

$sql = "SELECT * from products";
$a1 = $db->query($sql);
$num_row = $a1->num_rows;

$cantidadDeProductos = 15;

$num_paginas = $num_row/$cantidadDeProductos;
$num_paginas = ceil($num_paginas);

if(isset($_GET['page']) && $_GET['page']>=1) $pagina_actual = $_GET['page'];
else $pagina_actual = 1;

$primero = ($cantidadDeProductos*$pagina_actual)-$cantidadDeProductos;

$sql2 = "SELECT * FROM products LIMIT $primero, $cantidadDeProductos";
$a2 = $db->query($sql2);
$consulta = $a2->fetch_object();

if(isset($_POST['add'])){
  $pID = $_POST['add'];

  $sql3 = "SELECT * FROM cart WHERE p_id='$pID' and ssid='$ssid'";
  $b2 = $db->query($sql3);
  $con = $b2->fetch_object();

  if(mysqli_num_rows($b2)>0) {
    $sql4 = "UPDATE cart SET qty=qty+1 where p_id='$pID' and ssid='$ssid'";
    $db->query($sql4);
  }else {
    $sql4 = "INSERT INTO cart (p_id, ssid, qty) VALUE ('$pID', '$ssid', '1')";
    $db->query($sql4);
  }
  $url = $_SERVER['HTTP_REFERER'];
  header("Location: $url");
}

?>

<section id="productos">

<?php while($consulta!=null): ?>

    <article>
    
    <img src="img/product_images/<?= $consulta->product_image ?>" alt="">

    <h4><?= $consulta->product_title ?></h4>

    <p>€ <?= $consulta->product_price ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <button value="<?= $consulta->product_id ?>" class="btn btn-primary" name="add">Añadir al carrito</button>
    </form>

    </article>
    
    

<?php 
$consulta = $a2->fetch_object();
endwhile
?>

<!-- PAGINACIÓN -->
<nav id="navegacion" aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($pagina_actual>1): ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?=$pagina_actual-1?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php endif ?>
    <?php for ($i=1; $i <= $num_paginas; $i++): ?>
        
    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?= $i ?></a></li>

    <?php endfor ?>
    <?php if($pagina_actual<$num_paginas): ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?=$pagina_actual+1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
    <?php endif ?>
  </ul>
</nav>
<!-- FIN DE LA PAGINACIÓN -->

</section>