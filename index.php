<?php
    require_once 'config/param.php';
    require_once 'autoload.php';

    use Controllers\ErrorController;

    // Cabecera de la pagina
    require_once __DIR__ . '/views/layout/header.php';
?>

<html lang="es">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">

<body>
<main>
    <div id="central">
        <div class="productos">
            <img src="assets/img/lanaDelRey.jpg" alt="Vinilo Lana del Rey" width="100px">
            <h4>Lana del Rey</h4>
            <p>50€</p>
            <a href="carrito">Comprar</a>
        </div>

        <div class="productos">
            <img src="assets/img/arianaGrande.jpg" alt="Vinilo Ariana Grande" width="100px">
            <h4>Ariana Grande</h4>
            <p>35€</p>
            <a href="carrito">Comprar</a>
        </div>

        <div class="productos">
            <img src="assets/img/nirvana.jpg" alt="Vinilo Nirvana" width="100px">
            <h4>Nirvana</h4>
            <p>25€</p>
            <a href="carrito">Comprar</a>
        </div>
    </div>
</main>
</body>
</html>

<?php 
require_once __DIR__ . '/views/layout/footer.php'; 