<?php

// Importar la conexion 
require 'includes/app.php';
$DB = conectarDB();

// Crear un email y password
$email = "email@email.com";
$password = "123456";

$passwordHash = password_hash($password,PASSWORD_BCRYPT); // PASSWORD_DEFAULT
// var_dump($passwordHash);

// Query paracrear el usuario
$query = "INSERT INTO usuarios (email,password) VALUES ('$email', '$passwordHash' ); ";
// echo $query;

// Agregarlo a la base de datos
mysqli_query($DB,$query);