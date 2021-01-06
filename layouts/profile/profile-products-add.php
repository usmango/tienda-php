<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');
if($uType=="normal") header('Location: .');

$sqlCategorias = "SELECT * FROM categories";
$c1Categories = $db->query($sqlCategorias);
$consultaCategorias = $c1Categories->fetch_object();

$sqlBrands = "SELECT * FROM brands";
$c1Brands = $db->query($sqlBrands);
$consultaBrands = $c1Brands->fetch_object();



if(isset($_POST['addIt'])) {
  $target_dir = "C:/xampp/htdocs/tienda-online/img/product_images/";
  $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];

  $name = $_POST['name'];
  $cat = $_POST['categories'];
  $brand = $_POST['brands'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $file = $_FILES["fileToUpload"]["name"];

  $sqlAddProduct = "INSERT INTO products (product_title, product_cat, product_brand, product_price, product_desc, product_image)
                    VALUES ('$name','$cat','$brand','$price','$description','$file')";

  $db->query($sqlAddProduct);

  $dest_path = $target_dir . $file;

  move_uploaded_file($fileTmpPath, $dest_path);

  header('Location: profile.php?page=products');


}


?>

<section id="profile">

<form action="<?= $url ?>" method="POST" enctype="multipart/form-data" class="p-5">

<label for="name">Nombre del producto</label>
<input type="text" name="name" class="form-control" required>

<label for="categories">Categoria del producto</label>
<select name="categories" class="form-control">
<?php while($consultaCategorias!=null): ?>

  <option value="<?= $consultaCategorias->cat_id ?>"><?= $consultaCategorias->cat_title ?></option>

<?php
$consultaCategorias = $c1Categories->fetch_object();
endwhile ?>
</select>

<label for="brands">Marca del producto</label>
<select name="brands" class="form-control">
<?php while($consultaBrands!=null): ?>

  <option value="<?= $consultaBrands->brand_id ?>"><?= $consultaBrands->brand_title ?></option>

<?php 
$consultaBrands = $c1Brands->fetch_object();
endwhile ?>
</select>

<label for="price">Precio del producto</label>
<input type="number" name="price" min="0" max="9999" class="form-control" required>

<label for="description">Descripcion del producto</label>
<textarea name="description" cols="30" rows="10" class="form-control" required></textarea>

<label for="fileToUpload">Imagen del producto</label>
<input type="file" name="fileToUpload" class="form-control-file">

<input type="submit" name="addIt" value="Subir producto" class="form-control btn btn-success mt-5">

</form>

</section>