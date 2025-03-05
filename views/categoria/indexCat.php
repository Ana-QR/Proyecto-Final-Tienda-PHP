
<!-- filepath: /c:/xampp/htdocs/dashboard/ProyectoFinal/views/categoria/indexCat.php -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Categorías</h1>
    </div>
</header>

<div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-center mb-5">Gestionar Categorías</h1>
</div>

<div class="flex justify-center mt-5">
    <a href="<?= URL_BASE; ?>categoria/crearCategoria" class="inline-block mb-5 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
        Crear Categoría
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
        <?php while($cat = $categorias->fetch_object()): ?>
                <tr>    
                    <td><?=$cat->id;?></td>
                    <td><?=$cat->nombre;?></td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
</div>
