<?php

function conectarDB() : mysqli{
    
    $DB = new mysqli('localhost', 'root', '','bienesraices_crud');
    $DB->set_charset('utf8'); // Para que me reconozca los acentos y 'ñ' 
    
    if (!$DB) {
        echo "No se pudo conectar a la Base de Datos";
        exit;
    } 
    
    return $DB;
}