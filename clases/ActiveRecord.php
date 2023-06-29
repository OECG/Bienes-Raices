<?php

namespace App;

class ActiveRecord {
    
    # Base de Datos
    protected static $DB;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $formatosImage = ['.png','.jpg','.jpeg'];

    # Errores
    protected static  $errores = [];

    # Definir la conexion a la BD 
    public static function setDB($database){
        self::$DB = $database;
    }

    public function guardar() {
        
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear() {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la Base de Datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos));
        $query .= "' )";

        $resultado = self::$DB->query($query);
       
        if($resultado){
            // Redireccionar al Usuario
            header("location: /admin?resultado=1");
        }
    }

    public function actualizar() {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '".self::$DB->escape_string($this->id)."' ";
        $query .= "LIMIT 1 "; 
        // debuguear($query);
        $resultado = self::$DB->query($query);
        
        if($resultado){
            // Redireccionar al Usuario
            header("location: /admin?resultado=2");
        }
    }

     # Eliminar el registro
    public function eliminar(){
       
        $query = "DELETE FROM " . static::$tabla . " WHERE id =".self::$DB->escape_string($this->id)." LIMIT 1";
        
        $resultado = self::$DB->query($query);
       
        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');  // Redireccionar al Usuario (RECARGAR)
        }
    }

    # Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach( static::$columnasDB as $columna  ){
            if($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;

    }

    # Subida de Archivo
    public function setImagen($imagen) {
        
        # Eliminar Imagen Previea
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        
        # Asignar al Atributo de Imagen el nombre de la Imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    # Eliminar Imagen del servidor
    public function borrarImagen(){
        
        $existeArchivo = file_exists(CARPETA_IMAGENES.$this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);
        }
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key=>$value){
            $sanitizado[$key] = self::$DB->escape_string($value);
        }

        return $sanitizado;
    }

    public static function getErrores(){
        return static::$errores;
    }

    public function validar() { 
        static::$errores = [];
        return static::$errores;
    }

    # Lista todas los registros
    public static function findAll(){
        $query = "SELECT * FROM " . static::$tabla;
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    
    }

    # Lista todas los registros
    public static function findLimit($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    
    }

    # Buscar un registro por su id
    public static function findByPk($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    # Buscar un registro por su atributos
    public static function findByAttributes(array $atributos){

        $condiciones = [];
        foreach ($atributos as $key => $value) {
            $condiciones[] = $key."='".self::$DB->escape_string($value)."'";
        }
        
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";
        $query .= join(" AND ", $condiciones);

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function consultarSQL($query){
        # Consultar la base de datos
        $resultado = self::$DB->query($query);

        #Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        # Liberar la memoria
        $resultado->free();

        # Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    # Sincronizar el Objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
       
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}
