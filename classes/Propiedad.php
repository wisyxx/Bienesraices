<?php

namespace App;

class Propiedad
{
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
        $this->vendedorId = $args['vendedorId'] ?? null;
        $this->creado = $args['creado'] ?? null;
    }
}
