<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto p-4">
<h1 class="text-3xl font-bold">Productos disponibles</h1>
    <div class="grid grid-cols-3 gap-4 mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="border p-4 shadow-md rounded-lg">
                <img src="<?= URL_BASE . 'uploads/' . $producto['imagen'] ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" class="w-full h-48 object-cover rounded-md">
                <h2 class="text-xl font-semibold mt-2"><?= htmlspecialchars($producto['nombre']) ?></h2>
                <p class="text-gray-700"><?= htmlspecialchars($producto['precio']) ?>€</p>
                <a href="<?= URL_BASE ?>producto/ver&id=<?= $producto['id'] ?>" class="block mt-2 bg-blue-500 text-white text-center px-4 py-2 rounded-md">Ver más</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>