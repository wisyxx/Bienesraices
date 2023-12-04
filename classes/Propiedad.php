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
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->garages = $args['garages'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? 1;
        $this->creado = date('Y/m/d');
    }

    public function guardarEntradaDB()
    {
        if (!is_null($this->id)) {
            $this->actualizarEntradaDB();
        } else {
            $this->crearEntradaDB();
        }
    }

    public function crearEntradaDB()
    {
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO propiedades (";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "');";

        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizarEntradaDB()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = " UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1;";

        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=2');
        }

        return $resultado;
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

    public function eliminar()
    {
        $queryBorrar = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        $resultado = self::$db->query($queryBorrar);

        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public function setImagen($imagen)
    {
        // If we are updating replace the last image with the new one
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    /* VALIDACION */
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria, 
        escribe al menos 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
        if (!$this->wc) {
            self::$errores[] = "El numero de baños es obligatorio";
        }
        if ($this->garages < 0 || $this->garages > 10) {
            self::$errores[] = "El numero de garages es obligatorio";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Seleccione un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "Suba una imagen";
        }

        return self::$errores;
    }

    // Listar todos los registros 
    public static function all()
    {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su ID
    public static function find($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = $id";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sync($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
