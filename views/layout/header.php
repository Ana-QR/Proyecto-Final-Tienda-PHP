<?php
    require_once __DIR__ . '/../../controllers/CategoriaController.php';

    use Controllers\CategoriaController;

    $categoriaController = new CategoriaController();
    $categorias = $categoriaController->listarCategorias();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>

<body style="background-color:#6b7280; font-family: Arial, sans-serif; color: #1a1a1a;">
    <header id="header">
        <nav class="bg-white border-gray-300">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="ProyectoFinal/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="<?=URL_BASE?>assets/img/logo.jpg" alt="Logo" class="h-16 md:h-12 w-auto">
                    <span class="self-left text-2xl font-semibold whitespace-nowrap text-black">Tienda Vinilos</span>
                </a>

                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <span class="text-gray-900 dark:text-white"><?php echo $_SESSION['usuario']['nombre']; ?> <?php echo $_SESSION['usuario']['apellido']; ?></span>
                            <a href="http://localhost/dashboard/ProyectoFinal/views/usuario/logout.php" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center ml-2">
                                Cerrar sesión
                            </a>
                        <?php else: ?>
                            <a href="http://localhost/dashboard/ProyectoFinal/views/usuario/login.php" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center ml-2">
                                Iniciar sesión
                            </a>
                        <?php endif; ?>
                    </div>

                    <a href="http://localhost/dashboard/ProyectoFinal/views/usuario/registro.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2">
                        Registrarse
                    </a>
                    <button data-collapse-toggle="navbar-cta" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-cta" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
            </div>


            <div class="items-center justify-center hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col items-center font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-100 
                    md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-100 md:dark:bg-white dark:border-gray-300">

                    <li><a href="/inicio" class="block py-2 px-3 md:p-0 text-black bg-red-600 rounded-sm md:bg-transparent 
                              md:text-red-600" aria-current="page">Inicio</a></li>
                    <li><a href="/categorias" class="block py-2 px-3 md:p-0 text-gray-700 rounded-sm hover:bg-gray-200 md:hover:bg-transparent 
                              md:hover:text-red-600 dark:text-black dark:hover:bg-gray-200 
                              dark:hover:text-black md:dark:hover:bg-transparent dark:border-gray-300">Categorias</a></li>
                    <li><a href="/pedidos" class="block py-2 px-3 md:p-0 text-gray-700 rounded-sm hover:bg-gray-200 md:hover:bg-transparent 
                              md:hover:text-red-600 dark:text-black dark:hover:bg-gray-200 
                              dark:hover:text-black md:dark:hover:bg-transparent dark:border-gray-300">Pedidos</a></li>
                    <li><a href="/productos" class="block py-2 px-3 md:p-0 text-gray-700 rounded-sm hover:bg-gray-200 md:hover:bg-transparent 
                              md:hover:text-red-600 dark:text-black dark:hover:bg-gray-200 
                              dark:hover:text-black md:dark:hover:bg-transparent dark:border-gray-300">Productos</a></li>
                </ul>
            </div>
        </nav>

        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="<?php echo URL_BASE ?>" class="text-white text-lg font-semibold">Mi Tienda</a>
                <ul class="flex space-x-4">
                    <li><a href="<?php echo URL_BASE ?>" class="text-gray-300 hover:text-white">Inicio</a></li>
                    <li class="relative">
                        <button class="text-gray-300 hover:text-white focus:outline-none">
                            Categorías ▼
                        </button>
                        <ul class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden group-hover:block">
                            <?php foreach ($categorias as $categoria): ?>
                                <li>
                                    <a href="<?php echo URL_BASE ?>categoria/ver&id=<?php echo $categoria['id'] ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                        <?php echo htmlspecialchars($categoria['nombre']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo URL_BASE ?>contacto" class="text-gray-300 hover:text-white">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>