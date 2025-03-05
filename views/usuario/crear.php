<?php
    require_once __DIR__ . '/../Lib/conexion.php';
    require_once __DIR__ . '/../models/Usuario.php';

    use Lib\Conexion;
    use Models\Usuario;

    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->getUsuario();

    // Si no hay usuarios, $usuarios es un array vacío
    if ($usuarios === null) {
        $usuarios = [];
    }

    require_once __DIR__ . '/../views/usuario/gestion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<div id="gestion_usuarios" class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

    <form action="../../controllers/UsuarioController.php" method="POST" class="form-usuario space-y-4">
        <input type="hidden" name="action" value="crear">
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
            <input type="text" name="apellidos" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="rol" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div>
            <input type="submit" value="guardar" class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" />
        </div>
    </form>
</div>