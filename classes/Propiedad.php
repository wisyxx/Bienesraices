<?php

namespace App;

class Propiedad
{
    /* DB */
    protected static $db;
    protected static $columnasDB = [
        'id', 'titulo', 'precio',
        'imagen', 'descripcion', 'habitaciones',
        'wc', 'garages', 'vendedorId', 'creado'
    ];

    /* ERRORES */
    protected static $errores;

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

    // Definir conexion con la DB
    public static function setDB($database)
    {
        self::$db = $database;
    }

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

    public function guardar()
    {
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO propiedades (";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";

        $resultado = self::$db->query($query);
    }

    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;

            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    /* VALIDACION */
    public static function getErrores()
    {
        return self::$errores;
    }
}
