<?php
session_start();

require_once __DIR__ . '/../../models/categoria.php';

use Models\Categoria;

$categoria = new Categoria();
$categorias = $categoria->getCategorias();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
</head>

<body>
<section class="bg-white mt-6">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-8">

    <?php if(isset($_SESSION['mensaje'])): ?>
                                <div class="<?= $_SESSION['mensaje']['tipo'] ?>">
                                        <?= $_SESSION['mensaje']['contenido'] ?>
                                </div>
                                <?php unset($_SESSION['mensaje']); ?>
                        <?php endif; ?>

            <form action="../../controllers/procesarProducto.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="guardar">
                    <div class="grid gap-6 sm:grid-cols-2 mt-6">

                            <div class="sm:col-span-2">
                                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required>
                            </div>
                            <div class="sm:col-span-2">
                                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" rows="2" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" required></textarea>
                            </div>
                            <div class="w-full">
                                    <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">Precio</label>
                                    <input type="number" name="precio" id="precio" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required>
                            </div>
                            <div class="w-full">
                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                                    <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required>
                            </div>
                            <div class="w-full">
                                    <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                                    <select name="categoria_id" id="categoria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5">
                                            <?php if (!empty($categorias)): ?>
                                                    <?php foreach($categorias as $categoria): ?>
                                                            <option value="<?= htmlspecialchars($categoria['id']) ?>">
                                                                    <?= htmlspecialchars($categoria['nombre']) ?>
                                                            </option>
                                                    <?php endforeach; ?>
                                            <?php else: ?>
                                                    <option value="">No hay categorías disponibles</option>
                                            <?php endif; ?>
                                    </select>
                            </div>
                    </div>
                    
                    <div class="mt-6">
                            <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900">Imagen del Producto</label>
                            <input type="file" name="imagen" id="imagen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" required>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 hover:bg-blue-800">
                            Crear Producto
                    </button>
            </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>
</html>
