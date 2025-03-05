<?php
session_start();

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <main class="container mx-auto p-4">

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Bienvenido, <?php echo htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellidos']); ?></h1>

            <?php
            if (isset($_SESSION['mensaje'])) {
                $mensaje = $_SESSION['mensaje'];
                $clase = $mensaje['tipo'] == 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                echo '<div class="p-4 mb-4 rounded ' . $clase . '">' . $mensaje['contenido'] . '</div>';
                unset($_SESSION['mensaje']);
            }
            ?>
            <div class="mb-6">
                <h3 class="text-lg font-semibold">Correo electrónico asociado a la cuenta: </h3>
                <p><strong>Email: </strong><?php echo htmlspecialchars($usuario['email']); ?></p>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Acciones</h3>
                <ul class="list-disc list-inside">
                    <li><a href="editar.php" class="text-blue-500 hover:underline">Editar perfil</a></li>
                </ul>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Acciones</h3>
                <ul class="list-disc list-inside">
                    <li><a href="editar.php" class="text-blue-500 hover:underline">Editar perfil</a></li>
                    <li><a href="../../controllers/UsuarioController.php?action=logout" class="text-red-500 hover:underline">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </main>
</body>

</html>