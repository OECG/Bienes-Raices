<?php

namespace App;

class Propiedad {

    # Base de Datos
    protected static $DB;
    protected static $columnaDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos', 'creado', 'vendedores_id'];

    # Errores
    protected static  $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;

    # Definir la conexion a la BD 
    public static function setDB($database){
        self::$DB = $database;
    }

    public function __construct( $args = []) {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedorId'] ?? '';
    }

    public function guardar() {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la Base de Datos
        $query = "INSERT INTO propiedades ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos));
        $query .= "' )";

        $resultado = self::$DB->query($query);
        return $resultado;

    }

    # Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach( self::$columnaDB as $columna  ){
            if($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;

    }

    public function setImagen($imagen) {
        # Asignar al Atributo de Imagen el nombre de la Imagen
        if($imagen){
            $this->imagen = $imagen;
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
        return self::$errores;
    }

    public function validar() {

        if(!$this->titulo){
            self::$errores[] = "Debes añadir un título";
        }
        if(!$this->precio){
            self::$errores[] = "El Precio es Obligatorio";
        }
        if(!$this->imagen){
            self::$errores[] = "La Imagen es Obligatoria";
        }
        if( strlen($this->descripcion) < 50){
            self::$errores[] = "La descripciín debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El Número de Habitaciones es Obligatorio";
        }
        if(!$this->wc){
            self::$errores[] = "El Número de Baños es Obligatorio";
        }
        if(!$this->estacionamientos){
            self::$errores[] = "El Número de lugares de Estacionamiento es Obligatorio";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Elige un vendedor";
        }
        
        return self::$errores;
    }
    
}