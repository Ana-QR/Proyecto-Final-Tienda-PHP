<?php
require_once __DIR__ . '/../../config/param.php';
require_once __DIR__ . '/../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body class="h-screen bg-gray-700 text-white">
    <div class="flex justify-center items-center h-screen mt-10">
    <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
        <h1 class="text-3xl font-bold text-center mb-5 text-yellow-400 font-serif">Registro</h1>
        
        <?php if (isset($_SESSION['registro']) && $_SESSION['registro'] == 'correcto'): ?>
            <strong class="block text-green-400 text-center">Registro completado correctamente</strong>
        <?php elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == 'incorrecto'): ?>
            <strong class="block text-red-400 text-center">Registro fallido</strong>
        <?php endif; ?>
        
        <form action="<?= URL_BASE; ?>usuario/registrarUsuario" method="POST" class="space-y-4">
            <div>
                <label for="nombre" class="block text-yellow-400">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" required />
            </div>
            <div>
                <label for="apellido" class="block text-yellow-400">Apellidos</label>
                <input type="text" id="apellido" name="apellido" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" required />
            </div>
            <div>
                <label for="email" class="block text-yellow-400">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" placeholder="name@algo.com" required />
            </div>
            <div>
                <label for="password" class="block text-yellow-400">Contraseña</label>
                <input type="password" id="password" name="password" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" required />
            </div>
            <div class="flex items-center">
                <input id="recuerdame" name="recuerdame" type="checkbox" value="1" class="w-4 h-4 border border-gray-600 bg-gray-700 focus:ring-yellow-500">
                <label for="recuerdame" class="ml-2 text-sm text-yellow-400">Recuérdame</label>
            </div>
            <button type="submit" class="w-full bg-yellow-400 text-black font-bold py-2 px-4 rounded-md hover:bg-yellow-500 transition">Registrarse</button>
            <p class="text-sm text-center">
                ¿Ya tienes una cuenta? <a href="<?= URL_BASE; ?>usuario/login" class="text-yellow-400 hover:underline">Inicia sesión aquí</a>.
            </p>
        </form>
    </div>
    </div>
</body>

</html>