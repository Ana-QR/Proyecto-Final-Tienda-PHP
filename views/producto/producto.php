<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoFinal/config/config.php';
    require_once URL_BASE . 'models/Producto.php';
    require_once URL_BASE . 'models/Categoria.php';
    require_once URL_BASE . 'helpers/Utils.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . URL_BASE . 'usuario/login.php');
    }

    if ($_SESSION['usuario']['rol'] != 'admin') {
        header('Location: ' . URL_BASE . 'usuario/login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Productos</title>
</head>

<body style="background-color:#6b7280; font-family: Arial, sans-serif; color: #1a1a1a;">
    <header id="header">
        <nav class="bg-white border-gray-300">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="ProyectoFinal/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="<?php echo URL_BASE ?>assets/img/logo.jpg" alt="Logo" class="h-16 md:h-12 w-auto">
                    <span class="self-left text-2xl font-semibold whitespace-nowrap text-black">Tienda Vinilos</span>
                </a>

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
    </header>

    <div class="flex justify-center mt-6">
        <h1 class="text-3xl font-bold text-gray-900">Creación de Productos</h1>
    </div>

    <section class="bg-white mt-6">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-8">
            <?php if (isset($_SESSION['errorProducto']) && $_SESSION['errorProducto'] == 'true') { ?>
                <div class="flex justify-center">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative" role="alert">
                        <span class="block sm:inline">Alguno de los campos es incorrecto.</span>
                    </div>
                </div>
                <?php unset($_SESSION['errorProducto']); } ?>

            <form action="<?php echo URL_BASE ?>producto/guardarProducto" method="POST" enctype="multipart/form-data">
                <div class="grid gap-6 sm:grid-cols-2 mt-6">
                    <div class="sm:col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
                    </div>
                    <div class="w-full">
                        <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">Precio</label>
                        <input type="number" name="precio" id="precio" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
                    </div>
                    <div class="w-full">
                        <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                        <select id="categoria" name="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5">
                            <?php
                            use Helpers\Utils;
                            //$categorias = Utils::verCategorias();
                            foreach($categorias as $categoria){
                            ?>
                                <option value="<?php echo $categoria["id"] ?>"><?php echo $categoria["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                        <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" rows="2" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"></input>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900">Imagen del Producto</label>
                    <input type="file" name="imagen" id="imagen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" required="">
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 hover:bg-blue-800">
                    Añadir producto
                </button>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>