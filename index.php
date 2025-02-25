<?php

    ob_start();
    session_start();
    require_once __DIR__ . '/config/param.php';
    require_once __DIR__ . '/autoload.php';

    define('ACTION_DEFAULT', 'index'); // Define la acción predeterminada
    define('CONTROLLER_DEFAULT', 'HomeController'); // Define el controlador predeterminado

    use Controllers\ErrorController;

    // Cabecera de la pagina
    require_once __DIR__ . '/views/layout/header.php';

    function show_error(){
        $error = new ErrorController();
        $error->index();
    }

    if(isset($_GET['controller'])){
        $nombre_controlador = $_GET['controller'] . 'Controller';

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $nombre_controlador = CONTROLLER_DEFAULT;
    }else{
        show_error();
        exit();
    }

    if(class_exists($nombre_controlador)){
        $controlador = new $nombre_controlador();

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            $action_default = ACTION_DEFAULT;
            $controlador->$action_default();
        }else{
            show_error();
        }
    }else{
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