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
    <title>Iniciar sesión</title>
</head>

<body class="h-screen bg-gray-700 text-white">
    <div class="flex justify-center items-center h-screen mt-10">
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <h1 class="text-3xl font-bold text-center mb-5 text-yellow-400 font-serif">Iniciar sesión</h1>

            <!-- Mostrar mensajes de sesion -->
            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'correcto'): ?>
                <strong class="block text-green-400 text-center">Inicio de sesión completado correctamente</strong>
            <?php endif; ?>

            <!-- Mostrar mensajes de error -->
            <?php if (isset($_SESSION['error'])) : ?>
                <p class="text-red-400 text-center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <!-- Formulario de inicio de sesión -->
            <form action="<?= URL_BASE ?>usuario/loginUsuario" method="POST" class="space-y-4">
                <!--Campo de solicitud de correo electrónico-->
                <div>
                    <label for="email" class="block text-yellow-400">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" placeholder="name@algo.com" required />
                </div>

                <!--Campo de solicitud de contraseña-->
                <div>
                    <label for="password" class="block text-yellow-400">Contraseña</label>
                    <input type="password" id="password" name="password" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" required />
                </div>

                <!--Campo de solicitud de recordar contraseña-->
                <div class="flex items-center">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-600 bg-gray-700 focus:ring-yellow-500">
                    <label for="remember" class="ml-2 text-sm text-yellow-400">Recuérdame</label>
                </div>

                <!--Botón de envío de formulario-->
                <button type="submit" class="w-full bg-yellow-400 text-black font-bold py-2 px-4 rounded-md hover:bg-yellow-500 transition">Enviar</button>
                <p class="text-sm text-center">
                    ¿No tienes una cuenta? <a href="<?= URL_BASE; ?>usuario/mostrarFormularioRegistro" class="text-yellow-400 hover:underline">Regístrate aquí</a>.
                </p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>