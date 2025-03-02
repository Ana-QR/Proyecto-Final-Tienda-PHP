<div id="gestion_usuarios" class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    <!-- Mostrar errores si existen -->
    <?php if (isset($_SESSION['usuario_errors'])): ?>
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                <?php foreach ($_SESSION['usuario_errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['usuario_errors']); ?>
    <?php endif; ?>

    <form action="<?= URL_BASE ?>usuario/updateAdmin" method="POST" class="form-usuario space-y-4">
        <input type="hidden" name="id" value="<?= $usuario->id ?>" />

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" value="<?= $usuario->nombre ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
        </div>

        <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
            <input type="text" name="apellidos" value="<?= $usuario->apellidos ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?= $usuario->email ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
        </div>

        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
            <div>
                <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="user" <?= $usuario->rol == "user" ? 'selected' : '' ?>>Usuario</option>
                    <option value="admin" <?= $usuario->rol == "admin" ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>
        <?php else: ?>
            <input type="hidden" name="rol" value="<?= $usuario->rol ?>" />
        <?php endif; ?>

        <div>
            <input type="submit" value="Actualizar" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" />
        </div>
    </form>
</div>

<!-- Validación -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector(".form-usuario");

        form.addEventListener("submit", function(event) {
            let valid = true;
            let errorMessage = "";

            // Obtener valores de los campos
            const nombre = form.nombre.value.trim();
            const apellidos = form.apellidos.value.trim();
            const email = form.email.value.trim();
            const password = form.password.value.trim();
            const rol = form.rol.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre) || nombre.length < 2) {
                valid = false;
                errorMessage += "El nombre debe contener solo letras y tener al menos 2 caracteres.\n";
            }

            if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(apellidos) || apellidos.length < 2) {
                valid = false;
                errorMessage += "Los apellidos deben contener solo letras y tener al menos 2 caracteres.\n";
            }

            // Validar email
            if (!emailPattern.test(email)) {
                valid = false;
                errorMessage += "Introduce un email válido.\n";
            }

            if (password.length > 0 && (password.length < 6 || !/[A-Z]/.test(password) || !/[0-9]/.test(password))) {
                valid = false;
                errorMessage += "Si cambias la contraseña, debe tener al menos 6 caracteres, una mayúscula y un número.\n";
            }

            // Validar rol
            if (rol !== "user" && rol !== "admin") {
                valid = false;
                errorMessage += "Selecciona un rol válido.\n";
            }

            if (!valid) {
                alert(errorMessage);
                event.preventDefault();
            }
        });
    });
</script>