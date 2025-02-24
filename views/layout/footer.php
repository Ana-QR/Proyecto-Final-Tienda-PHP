<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

<?php require_once __DIR__ . '/views/layout/footer.php'; ?>

<!-- Contenido -->
<div id="central">
    <div class="productos">
        <img src="assets/img/lanaDelRey.jpg" alt="Vinilo Lana del Rey" class="product-image">
        <h4>Lana del Rey</h4>
        <p>50€</p>
        <a href="carrito">Comprar</a>
    </div>

    <div class="productos">
        <img src="assets/img/arianaGrande.jpg" alt="Vinilo Ariana Grande" class="product-image">
        <h4>Ariana Grande</h4>
        <p>35€</p>
        <a href="carrito">Comprar</a>
    </div>

    <div class="productos">
        <img src="assets/img/nirvana.jpg" alt="Vinilo Nirvana" class="product-image">
        <h4>Nirvana</h4>
        <p>25€</p>
        <a href="carrito">Comprar</a>
    </div>
</div>

<style>
    .product-image {
        width: 100px;
    }
</style>

</body>

</html>