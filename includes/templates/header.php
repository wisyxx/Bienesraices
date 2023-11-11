<?php

declare(strict_types=1);

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes raices</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/build/css/app.css" />
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/"><img src="/build/img/logo.svg" alt="Logo Bienes Raices" /></a>
                <div class="movil-menu">
                    <img src="/build/img/barras.svg" alt="icono menu" class="img-menu" />
                </div>

                <div class="derecha">
                    <img class="dark-btn" src="/build/img/dark-mode.svg" alt="Boton dark mode" />
                    <nav class="navegacion hide">
                        <a href="/nosotros.php">Nosotros</a><a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="cerrar-sesion.php">Cerrar sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>