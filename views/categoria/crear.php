<!-- filepath: /c:/xampp/htdocs/dashboard/ProyectoFinal/views/categoria/crear.php -->
<section class="bg-white mt-10">
  <div class="py-12 px-4 mx-auto max-w-4xl lg:py-20 lg:px-8">
      <h2 class="mb-6 text-2xl font-bold text-gray-900">Añade una nueva categoría</h2>
      <!-- Manejo de errores al escribir la categoria -->
        <?php if (isset($_SESSION['errorCategoria']) && $_SESSION['errorCategoria'] == 'true') : ?>
            <div class="flex justify-center mt-4">
                <div>
                    <strong class="text-red-500">Error al crear la categoría</strong>
                    <span class="block text-sm text-gray-500">El nombre de la categoría no es válido</span>
                </div>
            </div>
        <?php unset($_SESSION['errorCategoria']); ?>
        <?php endif; ?>

        <form action="<?= URL_BASE ?>categoria/guardar" method="POST" class="mt-10 px-8">
            <div class="flex flex-col mb-4">
                <label for="nombre" class="mb-2 text-sm text-gray-600">Nombre de la categoría</label>
                <input type="text" name="nombre" id="nombre" required = "" class="border p-2 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Crear Categoria</button>
        </form>
    </div>
</section>
            