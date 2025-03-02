<div id="products-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php while ($prod = $productos->fetch_object()) : ?>
        <div class="product border rounded-lg shadow-lg p-4">
            <img class="w-full h-48 object-cover mb-4" src="<?= URL_BASE ?>uploads/images/<?= $prod->imagen ?>" alt="<?= $prod->nombre ?>">
            <h2 class="text-xl font-semibold mb-2"><?= $prod->nombre ?></h2>
            <p class="text-lg font-medium text-gray-700 mb-4"><?= $prod->precio ?> €</p>
            <a href="" class="boton-producto bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Comprar</a>
        </div>
    <?php endwhile; ?>
</div>
