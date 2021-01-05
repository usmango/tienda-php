<?php
if(!isset($_SESSION['id'])) header('Location: .');

$sql = "SELECT * from user_info";
$a1 = $db->query($sql);
$num_row = $a1->num_rows;

$cantidadDeUsuarios = 8;

$num_paginas = $num_row/$cantidadDeUsuarios;
$num_paginas = ceil($num_paginas);

if(isset($_GET['pages']) && $_GET['pages']>=1) $pagina_actual = $_GET['pages'];
else $pagina_actual = 1;

$primero = ($cantidadDeUsuarios*$pagina_actual)-$cantidadDeUsuarios;

$sql2 = "SELECT * FROM user_info LIMIT $primero, $cantidadDeUsuarios";
$a2 = $db->query($sql2);
$consulta = $a2->fetch_object();


?>

<form action="profile.php" method="GET" class="text-right">
    <button class="btn btn-success" name="page" value="addUser">Añadir usuario</button>
</form>
<section id="profile" class="p-5">

<?php 
while($consulta!=null): 
if($consulta->status=="active") $status="alert-warning"; else $status="alert-danger";
?>

<div class="alert <?= $status ?> d-flex justify-content-between align-items-center" role="alert">
  <span>ID: <?= $consulta->user_id ?></span>
  <span>Nombre: <?= $consulta->first_name ?></span>
  <span>Apellido: <?= $consulta->last_name ?></span>
  <span>Tipo: <?= $consulta->user_type ?></span>
  <span>Status: <?= $consulta->status ?></span>
  
  <form action="profile.php" method="GET">
    <button name="editUser" value="<?= $consulta->user_id ?>" class="btn btn-success">Editar</button>
  </form>
</div>
<?php 
$consulta = $a2->fetch_object();
endwhile
?>

<!-- PAGINACIÓN -->
<nav id="navegacion" class="d-flex justify-content-end">
  <ul class="pagination">
  <?php if($pagina_actual>1): ?>
  <li class="page-item">
    <a class="page-link" href="?page=users&pages=<?=$pagina_actual-1?>" aria-label="Previous">
      <span aria-hidden="true">&laquo;</span>
      <span class="sr-only">Previous</span>
    </a>
  </li>
  <?php endif ?>
  <?php for ($i=1; $i <= $num_paginas; $i++): ?>
      
  <li class="page-item"><a class="page-link" href="?page=users&pages=<?=$i?>"><?= $i ?></a></li>

  <?php endfor ?>
  <?php if($pagina_actual<$num_paginas): ?>
  <li class="page-item">
    <a class="page-link" href="?page=users&pages=<?=$pagina_actual+1?>" aria-label="Next">
      <span aria-hidden="true">&raquo;</span>
      <span class="sr-only">Next</span>
    </a>
  </li>
  <?php endif ?>
  </ul>
  </nav>
<!-- FIN DE LA PAGINACIÓN -->

</section>