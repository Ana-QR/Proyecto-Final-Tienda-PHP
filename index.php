<?php

ob_start();
session_start();
require_once __DIR__ . '/config/param.php';
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/controllers/UsuarioController.php';

define('ACTION_DEFAULT', 'index'); // Define la acción predeterminada
define('CONTROLLER_DEFAULT', 'HomeController'); // Define el controlador predeterminado

use Controllers\ErrorController;
use Controllers\UsuarioController;

$usuario = new UsuarioController();

// Cabecera de la pagina
require_once __DIR__ . '/views/layout/header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    if ($_GET['action'] === 'registrar') {
        $usuario->registrarUsuario();
    } elseif ($_GET['action'] === 'login') {
        $usuario->inicioUsuario();
    }
}

/**
 * Function to display the error page.
 * This function creates an instance of the ErrorController and calls its index method.
 */
function show_error()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $nombre_controlador = 'controllers\\' . filter_var($_GET['controller'], FILTER_SANITIZE_SPECIAL_CHARS) . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = 'controllers\\' . CONTROLLER_DEFAULT . 'Controller';
} else {
    echo "Controlador no encontrado";
    show_error();
    exit();
}


// Compruebo si existe la clase
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = ACTION_DEFAULT;
        $controlador->$action_default();
    } else {
        echo "Acción por defecto no encontrada";
        show_error();
    }

} else {
    echo "Controlador no encontrado";
    show_error();
}

require_once __DIR__ . '/views/layout/footer.php';

ob_end_flush();
?>

<!-- Contenido
<div id="central">
    <div class="productos">
        <img src="assets/img/lanaDelRey.jpg" alt="Vinyl Lana del Rey" class="product-image">
        <h4>Lana del Rey</h4>
        <p>50€</p>
        <a href="carrito">Comprar</a>
    </div>

    <div class="productos">
        <img src="assets/img/arianaGrande.jpg" alt="Ariana Grande Vinyl" class="product-image">
        <h4>Ariana Grande</h4>
        <p>35€</p>
        <a href="carrito">Comprar</a>
    </div>

    <div class="productos">
        <img src="assets/img/nirvana.jpg" alt="Vinyl Nirvana" class="product-image">
        <h4>Nirvana</h4>
        <p>25€</p>
        <a href="carrito">Comprar</a>
    </div>
</div> -->