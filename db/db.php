<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'tienda-online';

@ $db = new mysqli($host, $user, $password, $db);

$error = $db->connect_errno;

if ($error != null) {
    $errorMYSQL = "<p>Se ha producido el error: $db->connect_error.</p>";
    exit();
}

?>