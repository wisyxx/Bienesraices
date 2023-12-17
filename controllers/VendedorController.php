<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {

        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** Crea una nueva instancia */
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    
    public static function actualizar(Router $router) {

        $id = redireccionar('/admin');
        $errores = Vendedor::getErrores();
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        $tipo = $_POST['tipo'];

        // peticiones validas
        if (validarTipoContenido($tipo)) {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            // Comparar para saber que eliminar
            if ($tipo === 'vendedor') {
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
            }
        }
    }
}
