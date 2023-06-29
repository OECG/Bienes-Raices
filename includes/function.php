<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTION_URL', __DIR__ . '/funcion.php');
define('CARPETA_IMAGENES', __DIR__ . '/../Imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{   
    include TEMPLATES_URL . "/{$nombre}.php";
}

function autenticado() : void {
    
    session_start();
    if(!$_SESSION['login']){
        header('location: /');
    }
}

function debuguear($variable,$op=true)
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
    $imgParts = explode('.', $imagen['imagen']);  # explode : Devuelve un array, cada elemento sera la parte del texto separado por un punto           
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

# Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor','propiedad'];

    return in_array($tipo,$tipos);
}

# Muestra Mensajes
function mostrarNotificaciones($codigo){
    $mensaje = '';
    $color = '';
    $response = [];

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            $color = 'verde';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            $color = 'amarillo';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            $color = 'rojo';
            break;
        default:
            $mensaje = false;
            $color = false;
            break;
    }

    $response = ['mensaje' => $mensaje, 'color'=> $color];
    
    return $response;
}