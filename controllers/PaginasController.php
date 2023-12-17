<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router) 
    {   
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router) 
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = redireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            // Crear instancia de PHPMailer y configurarlo
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '6eaf2962709815';
            $phpmailer->Password = '52ddc773555877';

            // Configurar el contenido del email
            $phpmailer->setFrom('admin@bienesraices.com');
            $phpmailer->addAddress('admin@bienesraices.com', 'bienesraices.com');
            $phpmailer->Subject = 'Tienes un nuevo mensaje';

            // Habilitar HTML
            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<h1>Tienes un nuevo mensaje</h1>';
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";

            if ($respuestas['contacto'] === 'Telefono') {
                $contenido .= "<p>Prefiere ser contactado por: " . $respuestas['contacto'] . "</p>";
                $contenido .= "<p>Fecha de contacto: " . $respuestas['fecha'] . "</p>";
                $contenido .= "<p>Hora de contacto: " . $respuestas['hora'] . "</p>";
                $contenido .= "<p>Telefono: " . $respuestas['telefono'] . "</p>";
            } else {
                $contenido .= "<p>Prefiere ser contactado por: " . $respuestas['contacto'] . "</p>";
                $contenido .= "<p>Email: " . $respuestas['email'] . "</p>";
            }

            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Comra: " . $respuestas['tipo'] . "</p>";
            $contenido .= "<p>Precio o presupuesto: " . $respuestas['precio'] . '$' . "</p>";
            $contenido .= '</html>';

            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = 'Texto plano sin HTML';

            if($phpmailer->send()) {
                $mensaje = 'Mensaje enviado';
            } else {
                $mensaje = 'Error al enviar el mensaje';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}