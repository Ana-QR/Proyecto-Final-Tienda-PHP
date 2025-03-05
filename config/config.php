<?php
// carga del autoload de composer para cargar las dependencias y clases necesarias para la aplicacion
    require __DIR__ . '/../vendor/autoload.php';

    // utiliza vlucas phpdotenv para cargar variables de entorno desde el archivo .env, en este caso informacion sobre 
    // las credenciales de la base de datos
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    define ('DB_HOST', 'localhost');
    define ('DB_USER', 'root');
    define ('DB_PASS', '');
    define ('DB_NAME', 'proyecto_final_tienda');
?>