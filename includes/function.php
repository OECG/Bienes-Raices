<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTION_URL', __DIR__ . '/funcion.php');

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

function debugear($variable,$op)
{
    echo'<pre>';
    var_dump($variable);
    echo'</pre>';
    if($op){
        exit;
    }
    
}