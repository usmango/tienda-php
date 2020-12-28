<?php
require_once('db/db.php');

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

?>

<section id="productos">

<?php while($consulta!=null): ?>

    <article>
    
    <img src="img/product_images/<?= $consulta->product_image ?>" alt="">

    <h4><?= $consulta->product_title ?></h4>

    <p>€ <?= $consulta->product_price ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <button value="<?= $consulta->product_id ?>" class="btn btn-primary" name="anadir">Añadir al carrito</button>
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