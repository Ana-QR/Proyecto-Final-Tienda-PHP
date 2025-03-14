<?php
require_once __DIR__ . '/../../models/Producto.php';
session_start();

use \Models\Producto;

$producto = new Producto();

// Obtener algunos productos aleatorios para la sección destacada
$productos = $producto->getProductosAleatorios(6); // Obtener 6 productos aleatorios

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Destacados</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">Productos Destacados</h1>
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
                <p class="text-center text-gray-700">No hay productos destacados en este momento.</p>
            <?php endif; ?> 
        </div>
    </main>
</body>
</html>
