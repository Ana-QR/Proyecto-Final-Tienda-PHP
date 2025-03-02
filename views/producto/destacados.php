<div id="products-container" class="flex justify-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    <h1 class="">Productos Destacados</h1>
</div>

<div class="product bg-white shadow-md rounded-lg overflow-hidden">

    <?php if ($productos): ?>
        <?php foreach ($productos as $product): ?>
            <div class="product bg-white shadow-md rounded-lg overflow-hidden">
                <a href="#">
                    <img class="w-full h-48 object-cover" src="<?= URL_BASE ?>assets/imag/<?= $product->imagen ?>" alt="product image" />
                </a>
                <div class="p-4">
                    <a href="#">
                        <h2 class="text-lg font-semibold text-gray-800"><?= $product->nombre ?></h2>
                    </a>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-gray-600"><?= $product->precio ?> €</span>
                        <a href="#" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Comprar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay productos para mostrar</p>
    <?php endif; ?>
</div>