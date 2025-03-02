<?php
ob_start(); // Iniciar el buffer de salida

session_start();// Iniciar la sesión

// Llamo a los controladores a través del autoload
require_once 'autoload.php'; // Archivo autoload
require_once 'config/param.php'; // Archivo de parámetros

use Controllers\ErrorController;

require_once __DIR__.'/views/layout/header.php'; // Layout header

function mostrarError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nombre_controlador = 'Controllers\\' . ucfirst($_GET['controller']) . 'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    // Configurado en el .htaccess 
    $nombre_controlador = 'Controllers\\' . ucfirst(controlador_base) . 'Controller';
}

if(isset($nombre_controlador) && class_exists($nombre_controlador)){
    // Creo un nuevo objeto de la clase controladora
    $controlador = new $nombre_controlador();
    // Invocando los métodos automáticamente
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = accion_por_defecto;
        $controlador->$action_default();
    }else{
        echo "La acción no se ha encontrado";
        mostrarError();
    }
}else{
    echo "El controlador no se ha encontrado";
    mostrarError();
}

require_once __DIR__.'/views/layout/footer.php'; // Layout footer
ob_end_flush(); // Liberar el buffer de salida
?>