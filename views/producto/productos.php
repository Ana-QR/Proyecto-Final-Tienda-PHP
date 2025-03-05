<?php
require_once __DIR__.'/../models/Producto.php';
session_start();

use \Models\Producto;

$producto = new Producto();

// Verificar si se pasó un ID de categoría por la URL
$categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
$productos = $categoria_id ? $producto->getProductosCategoria($categoria_id) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos por Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">Productos de la Categoria</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="../../index.php" class="hover:underline">Volver atrás</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-4">
        <div class="container mx-auto">
            <?php if(!empty($productos)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($productos as $producto): ?>
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h2 class="text-xl font-bold mb-2"><?= htmlspecialchars($producto['nombre']) ?></h2>
                            <p class="mb-2"><?= htmlspecialchars($producto['descripcion']) ?></p>
                            <p class="mb-2"><strong>Precio:</strong> <?= htmlspecialchars($producto['precio']) ?> €</p>
                            <p class="mb-2"><strong>Stock:</strong> <?= htmlspecialchars($producto['stock']) ?></p>
                            <img src="../../assets/img/<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen de <?= htmlspecialchars($producto['nombre']) ?>" class="w-full h-40 object-cover rounded-lg">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-700">No hay productos en esta categoría.</p>
            <?php endif; ?> 
        </div>
    </main>
</body>
</html>