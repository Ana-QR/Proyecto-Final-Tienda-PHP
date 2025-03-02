<?php
    // Se encarga de cargar las clases de los controladores
    function controllers_autoload($classname){
        $classname = str_replace("\\", "/", $classname);
        $file = __DIR__ . '/' . $classname . '.php';
        if (file_exists($file)) require_once $file;
    }

    // Registra la función autoload
    spl_autoload_register('controllers_autoload');

?>