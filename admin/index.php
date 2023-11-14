<?php

declare(strict_types=1);

// Sesion
require '../includes/app.php';
$auth = isAuth();

if (!$auth) {
    header('Location: login.php');
}

// Query
$query = "SELECT * FROM propiedades;";

$db = conectarDB();
$resultadoConsulta = mysqli_query($db, $query);

// Incluye plantilla
incluirTemplate('header');

// Mensaje condicional
$resultado = $_GET['resultado'] ?? null;
$usuario = $_GET['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        // Imagenes
        $queryImagen = "SELECT imagen FROM propiedades WHERE id = $id;";

        $resultadoImagen = mysqli_query($db, $queryImagen);
        $propiedad = mysqli_fetch_assoc($resultadoImagen);

        unlink("../imagenes/" . $propiedad['imagen']);

        // Eliminar propiedad
        $queryBorrar = "DELETE FROM propiedades WHERE id = $id;";
        $resultadoBorrar = mysqli_query($db, $queryBorrar);

        if ($resultadoBorrar) {
            header('Location: /admin?resultado=3');
        }
    }
}

?>

<main class="contenedor">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php elseif (intval($resultado) === 4) : ?>
        <p class="alerta sesion">Iniciado como: <strong><?php echo $usuario ?></strong></p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Crear nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <td>ID</td>
                <td>Titulo</td>
                <td>Imagen</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
        </thead>

        <!-- Mostrar resultados -->
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img class="imagen-tabla" src="../imagenes/<?php echo $propiedad['imagen'] ?>" alt="Imagen"></td>
                    <td><?php echo '$' .     $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'];  ?>" class="boton-amarillo-block separacion">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php

mysqli_close($db);

incluirTemplate('footer');

?>