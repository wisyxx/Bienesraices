<?php declare(strict_types = 1);
require "app.php";
function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL."/$nombre.php";
}

function isAuth() : bool {
    session_start();

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }
    return false;
}
?>