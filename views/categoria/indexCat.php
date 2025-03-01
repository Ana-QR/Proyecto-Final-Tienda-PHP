<h2 class="text-lg font-semibold">Listado de Categorías</h2>
<table class="border-collapse border border-gray-300">
    <tr class="bg-gray-200">
        <th class="border border-gray-300 p-2">ID</th>
        <th class="border border-gray-300 p-2">Nombre</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()): ?>
        <tr>
            <td class="border border-gray-300 p-2"><?= $cat->id; ?></td>
            <td class="border border-gray-300 p-2"><?= $cat->nombre; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
