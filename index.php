<?php
    require_once 'config/param.php';

    use Controllers\ErrorController;

    // Cabecera de la pagina
    require_once __DIR__ . '/views/layout/header.php';
    
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Tienda</title>
</head>

<body>
    <!-- Cabecera en layout/header.php-->

    <!-- Contenido -->
    <div id="central">
        <div class="productos" width=100px>
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
</body>

<!-- Pie de página en layout/footer.php-->

</html>