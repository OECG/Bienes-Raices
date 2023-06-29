<?php

namespace App;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos', 'creado', 'vendedor_id'];
    protected static $formatosImage = ['.png','.jpg','.jpeg'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedor_id;

    public function __construct( $args = []) {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedor_id = $args['vendedor_id'] ?? '';
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
        if(!$this->vendedor_id){
            self::$errores[] = "Elige un vendedor";
        }
        
        return self::$errores;
    }
}