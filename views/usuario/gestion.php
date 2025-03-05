<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../../index.php"); // Redirigir si no es admin
    exit();
}

require_once __DIR__ . '/../../Lib/conexion.php';

use Lib\conexion;

$db = new Conexion();

$stmt = $db->getPdo()->prepare("SELECT id, nombre, apellidos, email, rol FROM usuarios");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="bg-gray-800 p-4">
        <h1 class="text-3xl text-white">Panel de Administración</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="./crear.php" class="text-white"><i class="fas fa-plus"></i> Crear Usuario</a></li>
                <li><a href="../categoria/crear.php" class="text-white">Administrar Categorias</a></li>
                <li><a href="../producto/gestion.php" class="text-white">Administrar Productos</a></li>
                <li><a href="../../index.php" class="text-white">Volver a inicio</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-4">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Lista de Usuarios</h2>
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($usuario['nombre'] . " " . $usuario['apellidos']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($usuario['rol']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($_SESSION['usuario']['rol'] === 'admin') : ?>
                                    <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $usuario['id']; ?>" class="text-red-600 hover:text-red-900 ml-4">Eliminar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>