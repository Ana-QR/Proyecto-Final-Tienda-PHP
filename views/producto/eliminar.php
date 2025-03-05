<?php
    session_start();

    if(!isset($_GET['id'])){
        // Si no hay sesión o no hay ID, redirigir al panel de administración
        header('Location: ../views/usuario/gestion.php');
        exit();
    }

    require_once '../models/producto.php';
    use \Models\Producto;

    $productoId = $_GET['id'];

    $producto = new Producto();

    $producto = $producto->getProductosAleatorios($productoId);

    if (!$producto) {
        // Si no se encuentra el producto, redirigir a la lista de productos
        header('Location: gestion.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $productoEliminado = $producto->eliminar($productoId);

        if($productoEliminado){
            header('Location: gestion.php');
            exit();
        } else {
            $error = 'Error al eliminar el producto';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Tienda Online - Confirmar Eliminación</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="gestion.php" class="text-blue-500 hover:text-blue-700">Volver atrás</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">¿Estás seguro de que deseas eliminar este producto?</h2>

        <p class="mb-2"><strong>Nombre:</strong> <?= htmlspecialchars($producto['nombre']) ?></p>
        <p class="mb-4"><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?></p>
        <form action="../../controllers/procesarProducto.php" method="POST">
            <input type="hidden" name="action" value="eliminar">
            <input type="hidden" name="id" value="<?php echo $productoId; ?>">

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                <p>Una vez eliminado, no podrás recuperar este producto. ¿Deseas continuar?</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar Producto</button>
                <a href="gestion.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>