<?php declare(strict_types=1);

require "funciones.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";


/* Conectar DB */

$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);