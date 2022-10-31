<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTION_URL', __DIR__ . '/funcion.php');
define('CARPETA_IMAGENES', __DIR__ . '/../Imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{   
    include TEMPLATES_URL . "/${nombre}.php";
}

function autenticado() : void {
    
    session_start();
    if(!$_SESSION['login']){
        header('location: /');
    }
}

function debuguear($variable,$op)
{
    echo'<pre>';
    var_dump($variable);
    echo'</pre>';
    if($op){
        exit;
    }
}

function generarNombre( array $imagen = []) : string
{
    $imgParts = explode('.', $imagen['name']);  # explode : Devuelve un array, cada elemento sera la parte del texto separado por un punto           
    $extension = "." . end($imgParts);          # count : Devuelve la cantidad de elementos del array // end : Devuelve el ultimo elemento
            
    # Generar Nombre Unico
    $nombreImagen = md5( uniqid( rand(), true)) . $extension;

    return $nombreImagen;
}

# Escapa / sanitizar el HTML
function s($html) : string 
{
    $string = htmlspecialchars($html);
    return $string;
}
