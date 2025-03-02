<?php if(isset($categoria)): ?>
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold text-gray-900"><?=$categoria['nombre']?></h1>
    </div>

    <?php if(empty($productos)): ?>
        <p>No hay productos para mostrar</p>        
    <?php else: ?>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-8">
        <?php foreach ($productos as $producto): ?>
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="p-4 w-80 h-80 rounded-t-lg" src="<?= URL_BASE ?>assets/img/<?= $producto['imagen'] ?>" alt="product image" />
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?=$producto['nombre']?></h5>
                    </a>
                    <div class="flex items-center justify-between pt-4">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white"><?=$producto['precio']?>€</span>
                        <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Añadir al carrito</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
<?php else: ?>
    <h1>No existe dicha categoria</h1>
<?php endif; ?>