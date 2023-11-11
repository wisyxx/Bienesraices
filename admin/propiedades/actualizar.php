<?php

declare(strict_types=1);
// Sesion
require '../../includes/funciones.php';
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

// DB
require '../../includes/config/database.php';
$db = conectarDB();

// Obtener datos propiedad
$consultaPropiedad = "SELECT * FROM propiedades WHERE id = $id";
$resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
$propiedad = mysqli_fetch_assoc($resultadoPropiedad);

//Consultar vendedores
$consultaVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consultaVendedores);

// Mensajes de error
$errores = [];

$titulo = $propiedad['titulo'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$garages = $propiedad['garages'];
$descripcion = $propiedad['descripcion'];
$precio = $propiedad['precio'];
$vendedorId = $propiedad['vendedorId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $garages = mysqli_real_escape_string($db, $_POST['garages']);
    $wc = mysqli_real_escape_string($db, $_POST['baños']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    // Asignar $_FILES a una variable
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
    <h1>Actualiar propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend class="legend">Información general</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Tiulo propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" accept="image/jpeg, image/png" name="imagen" id="imagen" value="<?php echo $imagen ?>">
            <img src="<?php echo '/imagenes/' . $propiedad['imagen']; ?>" alt="imagen propiedad" class="small-img">

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend class="legend">Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="10" value="<?php echo $habitaciones ?>">

            <label for="baños">Baños:</label>
            <input type="number" name="baños" id="baños" placeholder="Ej: 3" min="1" max="4" value="<?php echo $wc ?>">

            <label for="garages">Garages:</label>
            <input type="number" name="garages" id="garages" placeholder="Ej: 3" min="0" max="4" value="<?php echo $garages ?>">
        </fieldset>
        <fieldset>
            <legend class="legend">Vendedor</legend>

            <select name="vendedor" id="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellidos']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>