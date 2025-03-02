<div id="gestion-productos" class="p-6">
    <h1 class="text-2xl font-bold mb-4">Gestion Productos</h1>
</div>

<div class="flex justify-center mt-5">
    <a href="<?= URL_BASE ?>producto/crearProducto" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">
        <button class="px-4 py-2 ml-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">Crear Nuevo Producto</span>
        </button>
    </a>
</div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">NOMBRE</th>
                    <th class="px-4 py-2 border-b">PRECIO</th>
                    <th class="px-4 py-2 border-b">STOCK</th>
                    <th class="px-4 py-2 border-b">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $product) { ?>
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b"><?= $product["id"] ?></td>
                        <td class="px-4 py-2 border-b"><?= $product["nombre"] ?></td>
                        <td class="px-4 py-2 border-b"><?= $product["precio"] ?> €</td>
                        <td class="px-4 py-2 border-b"><?= $product["stock"] ?></td>
                        <td class="px-4 py-2 border-b">
                            <a href="<?= URL_BASE ?>producto/editar&id=<?= $product["id"] ?>" class="text-blue-500 hover:underline mr-2">Editar</a>
                            <a href="<?= URL_BASE ?>producto/eliminar&id=<?= $product["id"] ?>" class="text-red-500 hover:underline" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>