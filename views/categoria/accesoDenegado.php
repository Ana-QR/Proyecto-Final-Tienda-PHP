<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-red-100">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md text-center">
        <h1 class="text-2xl font-bold text-red-600">Acceso Denegado</h1>
        <p class="text-gray-700 mt-4">No tienes permisos para acceder a esta página.</p>
        <a href="<?= URL_BASE; ?>" class="mt-6 inline-block px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
            Volver al inicio
        </a>
    </div>
</body>
</html>
