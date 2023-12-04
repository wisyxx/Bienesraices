<?php

declare(strict_types=1);

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

// Sesion
require '../../includes/app.php';
$auth = isAuth();

if (!$auth) {
    header('Replace: /login.php');
}

// Filtrar el id de la vivienda a actualizar
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

// Obtener datos propiedad
$propiedad = Propiedad::find($id);

//Consultar vendedores
$consultaVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consultaVendedores);

// Mensajes de error
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar atributos
    $args = $_POST['propiedad'];

    $propiedad->sync($args);

    $errores = $propiedad->validar();

    /** UPLOAD FILES **/

    // Generate unique names
    $nombreImagen = md5(uniqid(strval(rand(1, 100)), true)) . '.jpg';

    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        // Hacer resize a la imagen
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }
    if (empty($errores)) {
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        $resultado = $propiedad->guardarEntradaDB();
    }
}

incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Actualizar propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
    </form>
</main>

<?php
incluirTemplate('footer');
?>