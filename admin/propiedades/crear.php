<?php

declare(strict_types=1);

// DB
require '../../includes/app.php';
$db = conectarDB();

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

$consultaVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consultaVendedores);

$errores = Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    /** SUBIDA DE ARCHIVOS **/

    // Generar nombres únicos
    $nombreImagen = md5(uniqid(strval(rand(1, 100)), true)) . '.jpg';

    if ($_FILES['imagen']['tmp_name']) {
        // Hacer resize a la imagen
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    /* VALIDAR */
    $errores = $propiedad->validar();

    if (empty($errores)) {
        // Crear la carpeta para las imagenes
        $carpetaImagenes = "../../imagenes/";
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardarEntradaDB();

        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }
}

incluirTemplate('header');
?>

<!-- HTML -->
<main class="contenedor">
    <h1>Crear propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
    </form>
</main>

<?php
incluirTemplate('footer');
?>