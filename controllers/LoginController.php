<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router) {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new Admin($_POST['admin']);
            $errores = $admin->validar();

            if (empty($errores)) {

                // Revisar si el usuario existe.
                $resultado = $admin->existeUsuario();

                // Asignar el resultado del arreglo de resultado
                [$existe, $resultado] = $resultado;

                if ($existe) {
                    // Usuario existe, verificar su password
                    $resultado = $admin->verificarPassword($resultado);
                    [$auth] = $resultado;

                    // Verificar si el password es correcto o no
                    if (is_null($auth)) {
                        return header('Location: /admin');
                    } else {
                        $errores = $resultado[1];
                    }
                } else {
                    $errores = $resultado;
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    
    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}