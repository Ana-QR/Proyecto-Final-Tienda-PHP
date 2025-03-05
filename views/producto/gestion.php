<?php
require_once '../../controllers/ProductoController.php';
require_once '../../controllers/PedidoController.php';

use Controllers\ProductoController;
use Controllers\PedidoController;

$producto = new PedidoController();
$productos = $producto->gestion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="header-form bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl">Gestión de Productos</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="crear.php" class="hover:underline"><i class="fas fa-plus"></i> Añadir</a></li>
                <li><a href="../usuario/gestion.php" class="hover:underline">Volver atrás</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-6">
        <div class="admin-container">
            <h1 class="text-2xl font-bold mb-4">Productos disponibles</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border-b">ID</th>
                            <th class="px-4 py-2 border-b">Nombre</th>
                            <th class="px-4 py-2 border-b">Descripción</th>
                            <th class="px-4 py-2 border-b">Precio</th>
                            <th class="px-4 py-2 border-b">Stock</th>
                            <th class="px-4 py-2 border-b">Categoría</th>
                            <th class="px-4 py-2 border-b">Imagen</th>
                            <th class="px-4 py-2 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($productos) && is_array($productos)):?>
                            <?php foreach($productos as $producto): ?>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border-b"><?= $producto['id'] ?></td>
                                    <td class="px-4 py-2 border-b"><?= $producto['nombre'] ?></td>
                                    <td class="px-4 py-2 border-b"><?= $producto['descripcion'] ?></td>
                                    <td class="px-4 py-2 border-b"><?= $producto['precio'] ?> €</td>
                                    <td class="px-4 py-2 border-b"><?= $producto['stock'] ?></td>
                                    <td class="px-4 py-2 border-b"><?= $producto['categoria'] ?></td>
                                    <td class="px-4 py-2 border-b">
                                        <img src="../../../src/<?= $producto['imagen'] ?>" width="80" height="90" alt="Imagen">
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        <a href="editarProducto.php?id=<?= $producto['id']; ?>" class="text-blue-500 hover:underline mr-2">Editar</a>
                                        <a href="eliminarProducto.php?id=<?= $producto['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-4 py-2 border-b text-center">No se encontraron productos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>
</html>
