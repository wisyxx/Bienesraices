<?php

declare(strict_types=1);

use App\Propiedad;

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
    debug($propiedad);

    $imagen = $_FILES['imagen'];

    // Validar
    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria, 
        escribe al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }
    if (!$garages) {
        $errores[] = "El numero de garages es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Seleccione un vendedor";
    }

    // Validar tamaño
    $medida = 1000 * 1000;

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }


    if (empty($errores)) {
        /** SUBIDA DE ARCHIVOS **/

        $carpetaImagenes = "../../imagenes/";

        // Crear carpeta
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        if ($imagen['name']) {
            unlink($carpetaImagenes . $propiedad['imagen']);

            // Nombres únicos
            $nombreImagen = md5(uniqid(strval(rand(1, 100)), true)) . '.jpg';

            // Mover imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }

        // Query
        $query = " UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', 
        habitaciones = $habitaciones, wc = $wc, garages = $garages, vendedorId = $vendedorId WHERE id = $id; ";

        $resultado = mysqli_query($db, $query);
    }

    if ($resultado) {
        header('Location: /admin?resultado=2');
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