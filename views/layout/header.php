<?php
use Models\Categoria;

$categoria = new Categoria();
$categorias = $categoria->getCategorias();

// Manejo seguro de cookies para sesión
if (!isset($_SESSION['log']) && isset($_COOKIE['recuerdame'])) {
    $_SESSION['log'] = ['nombre' => htmlspecialchars($_COOKIE['recuerdame'], ENT_QUOTES, 'UTF-8')];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="<?= URL_BASE; ?>assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-screen text-white flex flex-col min-h-screen" style="background-color:rgb(119, 136, 159);">

    <!-- Barra de navegación -->
    <header>
        <nav class="bg-gray-800 border-gray-700 w-full">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
                <a href="<?= URL_BASE ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="<?= URL_BASE ?>assets/img/logo.jpg" alt="Logo" class="h-16 md:h-12 w-auto">
                </a>
                <div class="flex items-center space-x-4 md:order-2">
                    <?php if (isset($_SESSION['log'])): ?>
                        <a href="<?= URL_BASE ?>usuario/logout">
                            <button class="px-4 py-2 text-sm font-medium text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300">
                                Cerrar Sesión
                            </button>
                        </a>
                    <?php else: ?>
                        <a href="<?= URL_BASE ?>usuario/login">
                            <button class="px-4 py-2 text-sm font-medium text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300">
                                Iniciar Sesión
                            </button>
                        </a>
                        <a href="<?= URL_BASE ?>usuario/registro">
                            <button class="px-4 py-2 ml-6 text-sm font-medium text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300">
                                Registrarse
                            </button>
                        </a>
                    <?php endif; ?>
                    <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                    <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-600 rounded-lg md:p-0 bg-gray-800 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-800 w-full">
                        <?php if (isset($_SESSION['log'])): ?>
                            <li>
                                <p class="font-bold text-yellow-400 text-center mr-4"><?= htmlspecialchars($_SESSION['log']['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= URL_BASE ?>" class="block px-3 py-2 text-white bg-yellow-400 rounded-sm md:p-0 md:bg-transparent md:text-yellow-400">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="<?= URL_BASE ?>producto/index" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">
                                Productos
                            </a>
                        </li>
                        <li>
                            <a href="<?= URL_BASE ?>categoria/indexCat" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">
                                Categorías
                            </a>
                        </li>
                        <li>
                            <a href="<?= URL_BASE ?>usuario/login" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="<?= URL_BASE ?>usuario/registro" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">
                                Registro
                            </a>
                        </li>
                        <?php if (!empty($categorias) && is_array($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <li>
                                    <a href="<?= URL_BASE ?>categoria/ver?id=<?= urlencode($categoria['id']) ?>" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">
                                        <?= htmlspecialchars($categoria["nombre"], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li>
                            <a href="#" class="block px-3 py-2 text-white rounded-sm md:p-0 hover:bg-gray-600 md:hover:bg-transparent md:hover:text-yellow-400">Contacto</a>
                        </li>
                        <?php if (isset($_SESSION['log']) && !empty($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                            <li>
                                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm hover:bg-gray-600 md:hover:bg-transparent md:border-0 md:hover:text-yellow-400 md:p-0 md:w-auto">
                                    Gestión de Administrador 
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownNavbar" class="z-10 hidden font-normal bg-gray-800 divide-y divide-gray-600 rounded-lg shadow-sm w-44">
                                    <ul class="py-2 text-sm text-white">
                                        <li><a href="<?= URL_BASE ?>usuario/gestion" class="block px-4 py-2 hover:bg-gray-600">Usuarios</a></li>
                                        <li><a href="<?= URL_BASE ?>categoria/default" class="block px-4 py-2 hover:bg-gray-600">Categorías</a></li>
                                        <li><a href="<?= URL_BASE ?>producto/gestion" class="block px-4 py-2 hover:bg-gray-600">Productos</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-1"></main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>
</html>
