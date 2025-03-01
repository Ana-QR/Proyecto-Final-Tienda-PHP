<?php
session_start();
require_once __DIR__ . '/../../config/param.php';
require_once __DIR__ . '/../../config/config.php';

// Verificar si el usuario tiene el rol de admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: " . URL_BASE . "acceso_denegado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categoría</title>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen dark:bg-gray-500">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-5">Crear Categoría</h1>

        <!-- Mostrar mensajes de sesión -->
        <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'correcto'): ?>
            <strong class="alert_green">Categoría creada correctamente</strong>
        <?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'incorrecto'): ?>
            <strong class="alert_red">Error al crear la categoría</strong>
        <?php endif; ?>

        <!-- Formulario de creación de categoría -->
        <form class="max-w-md mx-auto" action="<?= URL_BASE; ?>categoria/crearCategoria" method="POST">
            <!-- Nombre de la categoría -->
            <div class="mb-5">
                <p>Nombre</p>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la categoría</label>
                <input type="text" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!-- Descripción de la categoría -->
            <div class="mb-5">
                <p>Descripción</p>
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" rows="3" required></textarea>
            </div>

            <!-- Botón de enviar -->
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Crear Categoría
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>
