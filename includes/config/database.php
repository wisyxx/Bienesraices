<?php

declare(strict_types=1);
function conectarDB(): mysqli {
    $db = new mysqli('localhost', 'root', '177068', 'bienesraices_CRUD');

    if (!$db) {
        echo '❌ERROR: No se pudo conectar';
        exit;
    }

    return $db;
}
