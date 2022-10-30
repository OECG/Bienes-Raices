<?php 
require 'function.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';  // Si app.php se requiere en otra carpeta el ../ necesita de __DIR__

# Conectarnos a la BD
$DB = conectarDB();
use App\Propiedad;

Propiedad::setDB($DB);