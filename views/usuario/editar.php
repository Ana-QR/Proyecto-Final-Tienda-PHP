<div id="gestion_usuarios" class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>
</div>

<section class="bg-white mt-10">
    <div class="py-12 px-4 mx-auto max-w-4xl lg:py-20 lg:px-8">


        <form action="<?= URL_BASE ?>usuario/editarUsuario" method="POST" class="form-usuario space-y-4">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <div class="p-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="<?= $usuario->nombre ?>" required="" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                </div>

                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" value="<?= $usuario->apellidos ?>" required="" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="<?= $usuario->email ?>" required="" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña (opcional)</label>
                    <input type="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                <select id="rol" name="rol" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">
                Editar Usuario
            </button>
        </form>
    </div>
</section>