<?php

namespace App;

class Propiedad
{
    // DB
    protected static $db;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $garages;
    public $vendedorId;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? null;
        $this->precio = $args['precio'] ?? null;
        $this->imagen = $args['imagen'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
        $this->habitaciones = $args['habitaciones'] ?? null;
        $this->garages = $args['garages'] ?? null;
        $this->wc = $args['wc'] ?? null;
        $this->vendedorId = $args['vendedorId'] ?? null;
        $this->creado = date('Y/m/d');
    }

    public function guardar() {
        // Insertar la base de datos
        $query = "INSERT INTO propiedades 
        (titulo, precio, imagen, descripcion, habitaciones, garages, wc, vendedorId, creado) 
        VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', 
        '$this->garages', '$this->wc', '$this->vendedorId', '$this->creado');";

        $resultado = self::$db->query($query);
    }

    // Definir conexion con la DB
    public static function setDB($database) {
        self::$db = $database;
    }
}
