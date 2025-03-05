<?php
session_start();

require_once '../../../Lib/conexion.php';

use Lib\Conexion;
// Verifica si se ha enviado un ID de usuario válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de usuario no proporcionado.");
}

$idProducto = $_GET['id'];

try{
    $db = new Conexion();

    $stmt = $db->getPdo()->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $idProducto);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$producto){
        die("Producto no encontrado");
    }
}catch(PDOException $error){
    die("Error en la base de datos: " . $error->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="../producto/gestion.php" class="text-blue-500 hover:text-blue-700">Volver atrás</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <form action="../../controllers/procesarProducto.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                <input type="hidden" name="action" value="editar">

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio:</label>
                    <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                    <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                    <input type="text" name="categoria_id" value="<?= htmlspecialchars($producto['categoria_id']) ?>" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <!-- Mostrar la imagen actual -->
                <?php if (!empty($producto['imagen'])): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen Actual:</label>
                        <img src="../../assets/img/<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen del producto" class="mt-2 max-w-xs">
                    </div>
                <?php endif; ?>

                <!-- Input para subir una nueva imagen -->
                <div>
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Seleccionar nueva imagen:</label>
                    <input type="file" name="imagen" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>
</html>