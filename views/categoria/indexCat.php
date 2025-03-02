    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-5">Gestionar Categorías</h1>
    </div>

    <div class="flex justify-center mt-5">
        <a href="<?= URL_BASE; ?>categoria/crear" class="inline-block mb-5 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            <button class="px-4 py-2 ml-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">Crear Categoría</span>
            </button>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">NOMBRE</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat) { ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?= $cat["id"] ?></td>
                        <td class="py-2 px-4 border-b"><?= $cat["nombre"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>