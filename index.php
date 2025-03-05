<?php
ob_start(); // Iniciar el buffer de salida

session_start(); // Iniciar la sesión

// Llamo a los controladores a través del autoload
require_once 'autoload.php'; // Archivo autoload
require_once 'config/param.php'; // Archivo de parámetros
require_once 'Lib/conexion.php';

use Controllers\ErrorController;
use Lib\Conexion;

require_once __DIR__.'/views/layout/header.php'; // Layout header

$db = new Conexion();

function mostrarError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nombre_controlador = 'Controllers\\' . ucfirst($_GET['controller']) . 'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    // Configurado en el .htaccess 
    $nombre_controlador = 'Controllers\\' . ucfirst(controlador_base) . 'Controller';
}

if(isset($nombre_controlador) && class_exists($nombre_controlador)){
    // Creo un nuevo objeto de la clase controladora
    $controlador = new $nombre_controlador();
    // Invocando los métodos automáticamente
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = accion_por_defecto;
        $controlador->$action_default();
    }else{
        echo "La acción no se ha encontrado";
        mostrarError();
    }
}else{
    echo "El controlador no se ha encontrado";
    mostrarError();
}

$current_page = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyl Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-900 text-gray-100 font-sans">
    <main class="container mx-auto p-6 flex">
        <?php if ($current_page !== 'login.php' && $current_page !== 'registro.php'): ?>
            <!-- Sidebar (Solo se muestra si NO es login ni registro) -->
            <aside class="w-1/4 bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4 text-yellow-400">Categorías</h2>
                <ul class="space-y-2">
                    <?php
                    $stmt = $db->getPdo()->prepare("SELECT id, nombre FROM categorias LIMIT 3");
                    $stmt->execute();
                    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($categorias as $categoria): ?>
                        <li>
                            <a href="views/producto/productos.php?categoria=<?= htmlspecialchars($categoria['id']) ?>" 
                               class="text-yellow-300 hover:text-yellow-500 transition duration-300">
                                <i class="fas fa-music mr-2"></i><?= htmlspecialchars($categoria['nombre']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="views/categoria/categoria.php" class="block mt-4 text-yellow-300 hover:text-yellow-500">Ver más</a>
            </aside>
        <?php endif; ?>

        <!-- Main Content -->
        <section class="<?= ($current_page !== 'login.php' && $current_page !== 'registro.php') ? 'w-3/4' : 'w-full' ?> bg-gray-800 p-6 rounded-lg shadow-md ml-6">
            <?php if(isset($_SESSION['usuario'])): ?>
                <h2 class="text-2xl font-bold mb-4 text-yellow-400">
                    Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?> <?= htmlspecialchars($_SESSION['usuario']['apellidos']) ?>
                </h2>
            <?php endif; ?>

            <?php if ($current_page !== 'login.php' && $current_page !== 'registro.php'): ?>
                <h3 class="text-xl font-bold mb-4 text-yellow-400">Explora nuestra colección</h3>
                
                <form action="views/producto/productos.php" method="GET" class="mb-6 flex">
                    <input type="text" name="buscar" placeholder="Buscar vinilos..." class="w-full p-2 rounded-l-lg border border-gray-600 focus:ring-2 focus:ring-yellow-400 bg-gray-700 text-gray-100">
                    <button type="submit" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-r-lg hover:bg-yellow-500">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <?php
                $stmtProductos = $db->getPdo()->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
                $stmtProductos->execute();
                $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

                if($productos): ?>
                    <div class="grid grid-cols-3 gap-6">
                        <?php foreach($productos as $producto): ?>
                            <div class="bg-gray-700 p-4 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                                <img src="assets/img/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" 
                                     class="w-full h-48 object-cover rounded-md mb-4">
                                <h4 class="text-lg font-bold text-yellow-300"> <?= htmlspecialchars($producto['nombre']) ?> </h4>
                                <p class="text-gray-400"> <?= htmlspecialchars($producto['descripcion']) ?> </p>
                                <p class="text-yellow-400 font-bold text-lg mt-2"> <?= number_format($producto['precio'], 2, ',', '.') ?>€ </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-red-400">No hay productos disponibles en este momento.</p>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>
    
    <footer class="bg-gray-800 text-gray-400 text-center p-4 mt-6">
        <?php require_once __DIR__.'/views/layout/footer.php'; ?>
    </footer>
</body>
</html>
<?php
ob_end_flush(); // Liberar el buffer de salida
?>