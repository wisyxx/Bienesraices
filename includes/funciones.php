<?php declare(strict_types=1);

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', 'funciones.php');
function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/$nombre.php";
}

function isAuth(): bool
{
    session_start();

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }
    return false;
}
?>