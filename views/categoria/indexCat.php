<?php
require_once __DIR__ . '/../../config/param.php';
require_once __DIR__ . '/../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Categorías</title>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen dark:bg-gray-500">
    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-5">Gestionar Categorías</h1>

        <a href="<?= URL_BASE; ?>categoria/crear" class="inline-block mb-5 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Crear Categoría
        </a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">NOMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($cat = $categorias->fetch_object()): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?= $cat->id; ?></td>
                        <td class="py-2 px-4 border-b"><?= $cat->nombre; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
</body>

</html>
