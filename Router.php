<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        $rutasProtegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/vendedores/crear',
            '/vendedores/actualizar'
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger rutas
        if (in_array($urlActual, $rutasProtegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) { // La URL existe
            call_user_func($fn, $this);
        } else {
            echo 'Page not found';
        }
    }

    public function render($view, $data = [])
    {

        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en la memoria por un momento
        include_once __DIR__ . "/views/$view.php";

        // Limpiar Buffer y almacenar en la variable su contenido
        $content = ob_get_clean();

        include_once __DIR__ . '/views/layout.php';
    }
}
