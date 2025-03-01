<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';
require_once __DIR__ . '/../../controllers/ProductoController.php';

use Controllers\CategoriaController;
use Controllers\ProductoController;

$categoriaController = new CategoriaController();
$categoria = $categoriaController->listarCategorias($_GET['id']);

$productoController = new ProductoController();
$productos = $productoController->getProductosPorCategoria($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoria['nombre']) ?></title>
</head>
<body>
    <h1 class="text-3xl font-bold"><?= htmlspecialchars($categoria['nombre']) ?></h1>
    
    <div class="grid grid-cols-3 gap-4">
        <?php foreach ($productos as $producto): ?>
            <div class="border p-4 shadow-md">
                <img src="<?= URL_BASE . 'uploads/' . $producto['imagen'] ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" class="w-full h-48 object-cover">
                <h2 class="text-xl font-semibold"><?= htmlspecialchars($producto['nombre']) ?></h2>
                <p class="text-gray-700"><?= htmlspecialchars($producto['precio']) ?>€</p>
                <a href="<?= URL_BASE ?>producto/ver&id=<?= $producto['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ver más</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
