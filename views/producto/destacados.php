<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">

<?php while($product = $productos->fetch_object()) : ?>
    <div class="product bg-white shadow-md rounded-lg overflow-hidden">

        <?php if($product->imagen != null): ?>
            <img class="w-full h-48 object-cover" src="<?=URL_BASE?>uploads/images/<?=$product->imagen?>" alt="Camiseta">
        <?php else: ?>
            <img class="w-full h-48 object-cover" src="<?=URL_BASE?>assets/img/no imagen.avif" alt="Camiseta">
        <?php endif; ?>
        
        <div class="p-4">
            <a href="<?=URL_BASE?>producto/ver&id=<?=$product->id?>">
                <h2 class="text-lg font-semibold text-gray-800"><?=$product->nombre?></h2>
            </a>
            <p class="text-gray-600 mt-2"><?=$product->precio?> €</p>
            <a href="<?= URL_BASE ?>carrito/add&id=<?=$product->id?>" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Comprar</a>
        </div>
    </div>
<?php endwhile; ?>
</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>