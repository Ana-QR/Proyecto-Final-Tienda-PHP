<div id="products-container" class="flex justify-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4 bg-gray-700 text-white">
    <h1 class="text-3xl font-bold text-center mb-5 text-yellow-400 font-serif">Productos Destacados</h1>
</div>

<div class="product bg-gray-800 shadow-lg rounded-lg overflow-hidden border border-gray-700">

    <?php if ($productos): ?>
        <?php foreach ($productos as $product): ?>
            <div class="product bg-gray-800 shadow-lg rounded-lg overflow-hidden border border-gray-700">
                <a href="#">
                    <img class="w-full h-48 object-cover" src="<?= URL_BASE ?>assets/img/<?= $product->imagen ?>" alt="product image" />
                </a>
                <div class="p-4">
                    <a href="#">
                        <h2 class="text-lg font-semibold text-yellow-400"><?= $product->nombre ?></h2>
                    </a>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-yellow-400"><?= $product->precio ?> €</span>
                        <a href="#" class="inline-block bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition">Comprar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-yellow-400">No hay productos para mostrar</p>
    <?php endif; ?>
</div>