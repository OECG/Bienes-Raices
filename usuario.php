<?php

require 'includes/config/database.php';
$db = conectarDB();

$email = 'oscar.ecg06@gmail.com';
$password = '123456';

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios (email,password) VALUES ('${email}', '${passwordHash}');";

echo $query;
//exit;
mysqli_query($db, $query);