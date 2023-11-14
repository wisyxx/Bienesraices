<?php

declare(strict_types=1);
require 'includes/app.php';
incluirTemplate('header');

// ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: /anuncios.php");
}

require './includes/config/database.php';
$db = conectarDB();

/** CONECTAR BASE DE DATOS **/

// Query
$queryPropiedades = "SELECT * FROM propiedades WHERE id = $id;";

// Resultado
$resultadoPropiedades = mysqli_query($db, $queryPropiedades);
$propiedad = mysqli_fetch_assoc($resultadoPropiedades);
?>

<main class="contenedor">
    <div class="caracteristicas-propiedad">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        <picture>
            <source srcset="<?php echo './imagenes/' . $propiedad['imagen']; ?>" type="image/jpg" />
            <img loading="lazy" width="200" height="300" src="<?php echo $propiedad['imagen']; ?>" alt="Imagen anuncio vivienda" />
        </picture>

        <div class="contenido-anuncio">

            <p><?php echo $propiedad['descripcion']; ?></p>

            <div class="contactar">
                <p>Si desea contactarnos para obtener más información
                    o empezar los tramites de compra,
                    pulse el boton "Más información"
                    y en el mensaje de contacto especifique
                    la vivienda, Gracias
                </p>
                <a href="contacto.php" class="boton boton-amarillo">Más información</a>
            </div>
        </div>
    </div>
    </div>
</main>

<?php
incluirTemplate('footer');
?>