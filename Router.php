<?php
namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
            
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if ($fn) { // La URL existe
            // debuguear($fn);
            call_user_func($fn, $this);
        } else {
            echo 'Page not found';
        }
    }

    public function render($view, $data = []) 
    {

        foreach($data as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en la memoria por un momento
        include_once __DIR__ . "/views/$view.php"; 

        // Limpiar Buffer y almacenar en la variable su contenido
        $content = ob_get_clean();

        include_once __DIR__ . '/views/layout.php';
    }
}
