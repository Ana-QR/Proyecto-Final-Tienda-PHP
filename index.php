<?php

ob_start();
session_start();
require_once __DIR__ . '/config/param.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/controllers/UsuarioController.php';

use Controllers\ErrorController;
use Controllers\UsuarioController;

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


if(isset($_GET['controller'])){

    $nombre_controlador = 'controllers\\' . $_GET['controller'] . 'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
    $nombre_controlador = 'controllers\\' . controlador_base . 'Controller';
    
}else{

    echo "Controlador no encontrado";
    show_error();
    exit();

}


// Compruebo si existe la clase
if(class_exists($nombre_controlador)){

    $controlador = new $nombre_controlador();

    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){

        $action = $_GET['action'];
        $controlador->$action();

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    
        $action_default = accion_por_defecto;
        $controlador->$action_default();
        
    }else{

        echo "Acción por defecto no encontrada";
        show_error();

    }

}else{

    echo "Controlador no encontrado";
    show_error();

}

require_once __DIR__ . '/views/layout/footer.php';


$controlador = $_GET['controller'] ?? 'inicio';
$accion = $_GET['action'] ?? 'index';

if ($controlador == 'usuario' && $accion == 'registro') {
    $usuarioController = new UsuarioController();
    $usuarioController->registro();
}
if ($controlador == 'usuario' && $accion == 'login') {
    $usuarioController = new UsuarioController();
    $usuarioController->login();
}

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