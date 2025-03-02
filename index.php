<?php

// Iniciar la sesión
session_start();

// Llamo a los controladores a través del autoload
require_once 'autoload.php'; // Archivo autoload
require_once 'config/config.php'; // Conexión a la base de datos
require_once 'config/param.php'; // Archivo de parámetros
require_once 'helpers/utils.php';
require_once 'views/layout/header.php'; // Layout header vista

use Controllers\ErrorController;


function mostrarError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    // Configurado en el .htaccess 
    $nombre_controlador = 'controllers\\' . controlador_base . 'Controller';
}else{
    // Si no existe el controlador, llama la función de errores
    mostrarError();
    exit();
}

if(isset($nombre_controlador) && class_exists($nombre_controlador, true)){
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
        mostrarError();
    }
}else{
    mostrarError();
}

require_once 'views/layout/footer.php'; // Layout footer
?>
