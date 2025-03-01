<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto p-4">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <img src="<?= URL_BASE . 'uploads/' . $productoData['imagen'] ?>" alt="<?= htmlspecialchars($productoData['nombre']) ?>" class="w-full h-64 object-cover rounded-md">
        <h1 class="text-2xl font-bold mt-4"><?= htmlspecialchars($productoData['nombre']) ?></h1>
        <p class="text-gray-600"><?= htmlspecialchars($productoData['descripcion']) ?></p>
        <p class="text-lg font-semibold mt-2"><?= htmlspecialchars($productoData['precio']) ?>€</p>
        <a href="<?= URL_BASE ?>carrito/agregar&id=<?= $productoData['id'] ?>" class="block mt-4 bg-blue-500 text-white text-center px-4 py-2 rounded-md">Agregar al carrito</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
