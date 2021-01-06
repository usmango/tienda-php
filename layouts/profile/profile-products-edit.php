<?php
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(!isset($_SESSION['id'])) header('Location: .');
if($uType=="normal") header('Location: .');

$idproducto = $_GET['edit'];

$sql = "SELECT * from products WHERE product_id='$idproducto'";
$a1 = $db->query($sql);
$consultaProductoEditar = $a1->fetch_object();

$sqlCategorias = "SELECT * FROM categories";
$c1Categories = $db->query($sqlCategorias);
$consultaCategorias = $c1Categories->fetch_object();

$sqlBrands = "SELECT * FROM brands";
$c1Brands = $db->query($sqlBrands);
$consultaBrands = $c1Brands->fetch_object();

if(isset($_POST['removeIt'])) {
    $sqlRemove = "DELETE FROM products WHERE product_id='$idproducto'";
    $db->query($sqlRemove);
    header('Location: profile.php?page=products');
}


if(isset($_POST['editIt'])) {
    $target_dir = "C:/xampp/htdocs/tienda-online/img/product_images/";
    $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];

    if(!empty($_POST['name'])) $name=$_POST['name']; else $name=$consultaProductoEditar->product_title;
    if(!empty($_POST['categories'])) $categories=$_POST['categories']; else $categories=$consultaProductoEditar->product_cat;
    if(!empty($_POST['brands'])) $brands=$_POST['brands']; else $brands=$consultaProductoEditar->product_brand;
    if(!empty($_POST['price'])) $price=$_POST['price']; else $price=$consultaProductoEditar->product_price;
    if(!empty($_POST['description'])) $description=$_POST['description']; else $description=$consultaProductoEditar->product_desc;
    if(!empty($_FILES["fileToUpload"]["name"])) $file=$_FILES["fileToUpload"]["name"]; else $file=$consultaProductoEditar->product_image;

    $sqlUpdate = "UPDATE products SET product_title='$name', product_cat='$categories', product_brand='$brands', product_price='$price', product_desc='$description',
     product_image='$file' WHERE product_id='$idproducto'";
    $db->query($sqlUpdate);

    if(isset($_FILES["fileToUpload"]["name"])){
        $dest_path = $target_dir . $file;
        move_uploaded_file($fileTmpPath, $dest_path);
        header('Location: profile.php?page=products');
    } else {
        header('Location: profile.php?page=products');
    }
}



?>


<section id="profile">


<form action="<?= $url ?>" method="POST" enctype="multipart/form-data" class="p-5">

<label for="name">Nombre del producto</label>
<input type="text" name="name" class="form-control" value="<?= $consultaProductoEditar->product_title ?>">

<label for="categories">Categoria del producto</label>
<select name="categories" class="form-control">
<?php while($consultaCategorias!=null): ?>
    <?php if($consultaProductoEditar->product_cat==$consultaCategorias->cat_id) $cSelected='selected'; else $cSelected=''; ?>
  <option value="<?= $consultaCategorias->cat_id ?>" <?= $cSelected ?>><?= $consultaCategorias->cat_title ?></option>

<?php
$consultaCategorias = $c1Categories->fetch_object();
endwhile ?>
</select>

<label for="brands">Marca del producto</label>
<select name="brands" class="form-control">
<?php while($consultaBrands!=null): ?>
    <?php if($consultaProductoEditar->product_brand==$consultaBrands->brand_id) $bSelected='selected'; else $bSelected=''; ?>
  <option value="<?= $consultaBrands->brand_id ?>" <?= $bSelected ?>><?= $consultaBrands->brand_title ?></option>

<?php 
$consultaBrands = $c1Brands->fetch_object();
endwhile ?>
</select>

<label for="price">Precio del producto</label>
<input type="number" name="price" min="0" max="9999" class="form-control" value="<?= $consultaProductoEditar->product_price ?>">

<label for="description">Descripcion del producto</label>
<textarea name="description" cols="30" rows="10" class="form-control" value="<?= $consultaProductoEditar->product_description ?>"></textarea>

<label for="fileToUpload">Imagen del producto</label>
<input type="file" name="fileToUpload" class="form-control-file">

<input type="submit" name="editIt" value="Actualizar producto" class="form-control btn btn-success mt-2">
<input type="submit" name="removeIt" value="Eliminar producto" class="form-control btn btn-danger mt-1">

</form>


</section>