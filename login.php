<?php

declare(strict_types=1);
require 'includes/app.php';
incluirTemplate('header');

$db = conectarDB();

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, strval(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)));

    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = 'El e-mail es obligatorio';
    }
    if (!$password) {
        $errores[] = 'La contraseña es obligatoria';
    }

    if (empty($errores)) {
        $queryMail = "SELECT * FROM usuarios WHERE email = '$email';";
        $resultadoMail = mysqli_query($db, $queryMail);

        if ($resultadoMail->num_rows) {
            $usuario = mysqli_fetch_assoc($resultadoMail);
            
            $auth = password_verify($password, $usuario['password']);

            if ($auth) {
                session_start();

                // Llenar la sesión
                $_SESSION['usuario'] = $email;
                $_SESSION['login'] = true;
                header("Location: /admin?resultado=4&&usuario=$email");
            } else {
                $errores[] = 'Contraseña incorrecta';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }
}

?>

<main class="contenedor">
    <h1>Iniciar sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <fieldset>
            <legend class="legend">Correo y contraseña</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">

            <input class="boton-verde" type="submit" value="Iniciar Sesión">
        </fieldset>
    </form>
</main>

<?php
incluirTemplate('footer');
?>