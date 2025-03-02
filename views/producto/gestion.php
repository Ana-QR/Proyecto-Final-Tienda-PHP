<div id="gestion-productos" class="p-6">
    <h1 class="text-2xl font-bold mb-4">Gestion Productos</h1>

    <a href="<?= URL_BASE ?>producto/crear" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">
        Crear Producto
    </a>

    <?php Utils::borrarSesion('producto'); ?>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">NOMBRE</th>
                    <th class="px-4 py-2 border-b">PRECIO</th>
                    <th class="px-4 py-2 border-b">STOCK</th>
                    <th class="px-4 py-2 border-b">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pro = $productos->fetch_object()): ?>
                    <tr>
                        <td class="px-4 py-2 border-b"><?= $pro->id; ?></td>
                        <td class="px-4 py-2 border-b"><?= $pro->nombre; ?></td>
                        <td class="px-4 py-2 border-b"><?= $pro->precio; ?> €</td>
                        <td class="px-4 py-2 border-b"><?= $pro->stock; ?></td>
                        <td class="px-4 py-2 border-b">
                            <a href="<?= URL_BASE ?>producto/editar&id=<?= $pro->id ?>" class="text-blue-500 hover:underline mr-2">Editar</a>
                            <a href="<?= URL_BASE ?>producto/eliminar&id=<?= $pro->id ?>" class="text-red-500 hover:underline" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>