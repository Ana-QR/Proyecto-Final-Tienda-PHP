<?php

ob_start();

// Destruir sesión y cookies antes de iniciar una nueva sesión
session_unset();
session_destroy();
setcookie('remember', '', time() - 3600, '/');

session_start();
require_once __DIR__ . '/config/param.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/autoload.php';

define('accion_por_defecto', 'index'); // Define the default action
require_once __DIR__ . '/controllers/UsuarioController.php';

use Controllers\ErrorController;
use Controllers\UsuarioController;
use Models\Usuario;

$usuario = new UsuarioController();


// Cabecera de la pagina
require_once __DIR__ . '/views/layout/header.php';

/**
 * Función para mostrar la página de error.
 * Esta función crea una instancia de ErrorController y llama a su método de index.
 */
function show_error()
{
    $error = new ErrorController();
    $error->index();
}


function handle_routing()
{
    if (isset($_GET['controller'])) {
        $nombre_controlador = 'controllers\\' . $_GET['controller'] . 'Controller';
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $nombre_controlador = 'controllers\\UsuarioController';
    } else {
        echo "Controlador no encontrado";
        show_error();
        exit();
    }

    if (class_exists($nombre_controlador)) {
        $controlador = new $nombre_controlador();

        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            $action = $_GET['action'];
            $controlador->$action();
        } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $action_default = accion_por_defecto;
            $controlador->$action_default();
        } else {
            echo "Acción por defecto no encontrada";
            show_error();
        }
    } else {
        $controlador = new $nombre_controlador();
        $action = $_GET['action'] ?? accion_por_defecto;
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            // Error message indicating that the method was not found in the controller
            echo "Método no encontrado";
            show_error();
        }
        show_error();
    }
}

handle_routing();



$controlador2 = $_GET['controller'] ?? 'inicio';
$accion = $_GET['action'] ?? 'index';

if ($controlador2 == 'usuario' && $accion == 'registro') {
    $usuarioController = new UsuarioController();
    $usuarioController->registro();
}
if ($controlador2 == 'usuario' && $accion == 'login') {
    $usuarioController = new UsuarioController();
    $usuarioController->login();
}

//Verificar si la cookie existe
if (isset($_COOKIE['remember'])) {
    $usuario = new Usuario();

    $usuario->setId($_COOKIE['remember']);
    $inicio = $usuario->getUsuarioPorId($usuario->getId());

    if ($inicio && is_object($inicio)) {
        $_SESSION['inicio'] = $inicio;

        if ($inicio->getRol() === 'admin') {
            $_SESSION['admin'] = true;
        }
    }
}

// index.php (gestor de rutas)
if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . "Controller";

    if (class_exists($nombre_controlador)) {
        $controlador = new $nombre_controlador();

        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            $action = $_GET['action'];
            $controlador->$action();
        } else {
            echo "Método no encontrado";
        }
    } else {
        echo "Controlador no encontrado";
    }
}

require_once __DIR__ . '/views/layout/footer.php';
ob_end_flush();
?>