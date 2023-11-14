<?php

declare(strict_types=1);

// DB
require '../../includes/app.php';
$db = conectarDB();

// Importar clase Propiedad
use App\Propiedad;

//Consultar vendedores
$consultaVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consultaVendedores);

// Mensajes de error
$errores = [];

$titulo = '';
$habitaciones = '';
$garages = '';
$wc = '';
$descripcion = '';
$precio = '';
$vendedorId = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST);
    debug($propiedad);

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $garages = mysqli_real_escape_string($db, $_POST['garages']);
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
    if ($garages < 0 || $garages > 10) {
        $errores[] = "El numero de garages es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Seleccione un vendedor";
    }
    if(!$imagen['name']) {
        $errores[] = "Suba una imagen";
    }

    // Validar tamaño
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }


    if (empty($errores)) {
        /** SUBIDA DE ARCHIVOS **/

        // Crear carpeta
        $carpetaImagenes = "../../imagenes/";
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Nombres únicos
        $nombreImagen = md5(uniqid(strval(rand(1, 100)), true)) . '.jpg';

        // Mover imagen
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);

        // Insertar la base de datos
        $query = "INSERT INTO propiedades 
        (titulo, precio, imagen, descripcion, habitaciones, garages, wc, vendedorId, creado) 
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', 
        '$garages', '$wc', '$vendedorId', '$creado');";

        $resultado = mysqli_query($db, $query);
    }

    if ($resultado) {
        header('Location: /admin?resultado=1');
    }
}

incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Crear propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend class="legend">Información general</legend>

            <label for="titulo">Titulo:</label>
            <input maxlength="45" type="text" name="titulo" id="titulo" placeholder="Tiulo propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" accept="image/jpeg, image/png" name="imagen" id="imagen" value="<?php echo $imagen ?>">

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend class="legend">Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" value="<?php echo $habitaciones ?>">

            <label for="baños">Baños:</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" value="<?php echo $wc ?>">

            <label for="garages">Garages:</label>
            <input type="number" name="garages" id="garages" placeholder="Ej: 3" value="<?php echo $garages ?>">
        </fieldset>
        <fieldset>
            <legend class="legend">Vendedor</legend>

            <select name="vendedorId" id="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellidos']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>