<?php 

require 'includes/config/database.php';
$db = conectarDB();

$email = 'correo@correo';
$pass = '1234';

$passHash = password_hash($pass, PASSWORD_BCRYPT);
$query = "INSERT INTO usuarios (email, password) VALUES ($email, $pass);";

?>