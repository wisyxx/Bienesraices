<?php

namespace Model;

class Vendedor extends ActiveRecord {
    // Base DE DATOS
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono'];
    
    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if(!$this->apellidos) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] = "El Teléfono es Obligatorio";
        }

        if (!preg_match('/[0-9]{9}/', $this->telefono) && $this->telefono) {
            self::$errores[] = "Teléfono no válido";
        }

        return self::$errores;
    }

}