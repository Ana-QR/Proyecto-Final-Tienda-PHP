<?php 
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../views/usuario/login.php"); // Redirigir si no está autenticado
    exit();
}

$usuario = $_SESSION['usuario'];

// Solo los administradores pueden editar cualquier usuario
$puede_editar = false;
if ($usuario['rol'] === 'admin' || (isset($_GET['id']) && $_GET['id'] == $usuario['id'])) {
    $puede_editar = true;
}

if (!$puede_editar) {
    echo "<p>No tienes permiso para editar este usuario.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <div id="gestion_usuarios" class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>
    </div>

    <section class="bg-white mt-10">
        <div class="py-12 px-4 mx-auto max-w-4xl lg:py-20 lg:px-8">
            <?php
                if(isset($_SESSION['mensaje'])){
                    $mensaje = $_SESSION['mensaje'];
                    $clase = $mensaje['tipo'] == 'success' ? 'mensaje-exito' : 'mensaje-error';
                    echo '<div class="' . $clase . '">' . $mensaje['contenido'] . '</div>';
                    unset($_SESSION['mensaje']);
                }
            ?>
            <div class="formulario-container">
                <h1>Editar Perfil</h1>

                <form action="../../controllers/UsuarioController.php" method="POST" class="form-usuario space-y-4">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                        </div>

                        <div>
                            <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña (opcional)</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                        </div>
                    </div>

                    <?php if ($usuario['rol'] === 'admin') : ?>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                            <select id="rol" name="rol" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="usuario" <?= $usuario['rol'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
                                <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Editar Usuario</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
