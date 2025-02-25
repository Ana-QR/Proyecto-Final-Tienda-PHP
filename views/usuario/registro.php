<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen dark:bg-gray-500">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-5">Formulario de Registro</h1>

        <!-- Mostrar mensajes de sesion -->
        <?php if ((isset($_SESSION['registro'])) && $_SESSION['registro'] == "correcto"): ?>
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                <span class="font-medium">¡Registro completado con éxito!</span>
            </div>
        <?php elseif ((isset($_SESSION['registro'])) && $_SESSION['registro'] == "incorrecto"): ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                <span class="font-medium">El registro no se ha podido completar</span>
            </div>
        <?php endif ?>

        <!-- Formulario de registro -->
        <form class="max-w-md mx-auto" action="<?= URL_BASE; ?>usuario/registrarUsuario" method="POST">
            <!--Nombre-->
            <div class="mb-5">
                <p>Nombre</p>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!--Campo de solicitud de correo electrónico-->
            <div class="mb-5">
                <p>Email</p>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@algo.com" required />
            </div>

            <!--Campo de solicitud de contraseña-->
            <div class="mb-5">
                <p>Contraseña</p>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!-- Checkbox "Recuérdame" -->
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" name="remember" type="checkbox" value="1" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-500">Recuérdame</label>
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Registrarse
            </button>
        

        <!-- Enlace para iniciar sesión -->
        <p class="mt-5 text-sm text-gray-500 dark:text-gray-400 text-center">
            ¿Ya tienes una cuenta? <a href="<?= URL_BASE; ?>usuario/mostrarFormularioLogin" class="text-blue-600 hover:underline">Inicia sesión aquí</a>.
        </p>
    </form>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>