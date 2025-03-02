<div class="flex justify-center">
    <h1 class="text-3xl font-bold text-gray-900">Gestión de Usuarios</h1>
</div>


<div class="relative overflow-x-auto mt-8 align-middle shadow sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Apellidos
                </th>
                <th scope="col" class="px-6 py-3">
                    Rol
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-8 py-6 font-medium text-xl text-gray-900 whitespace-nowrap">
                        <?= $usuario["id"] ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= ucwords($usuario["nombre"]) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= ucwords($usuario["apellidos"]) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= ucwords($usuario["rol"]) ?>
                    </td>
                    <td class="px-6 py-4">
                    <a href="<?=URL_BASE?>usuario/edtar&id=<?=$usuario['id']?>">
                        <button type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 shadow-lg shadow-cyan-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Editar</button>
                    </a>
                </tr>
            <?php } ?>
        </tbody>  
    </table>
</div>