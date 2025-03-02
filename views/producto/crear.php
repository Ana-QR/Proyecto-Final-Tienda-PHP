<div class="flex justify-center">
    <h1 class="text-3xl font-bold text-gray-900">Creación de Productos</h1>
</div>

<section class="bg-white mt-6">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-8">

  <?php if (isset($_SESSION['errorProducto']) && $_SESSION['errorProducto'] == 'true') { ?>
    <div class="flex justify-center">
        <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative" role="alert">
            <span class="block sm:inline">Alguno de los campos es incorrecto.</span>
        </div>
    </div>
        <?php unset($_SESSION['errorProducto']);} ?>

      <form action="<?= URL_BASE ?>producto/guardarProducto" method="POST" enctype="multipart/form-data">
          <div class="grid gap-6 sm:grid-cols-2 mt-6">

              <div class="sm:col-span-2">
                  <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                  <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
              </div>
              <div class="w-full">
                  <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">Precio</label>
                  <input type="number" name="precio" id="precio" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
              </div>
              <div class="w-full">
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>
                    <select id="categoria" name="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-1.5">
                        <?php
                        use Helpers\Utils;
                        $categorias = Utils::mostrarCategorias();
                        foreach($categorias as $categoria){
                        ?>
                          <option value="<?= $categoria["id"] ?>"><?= $categoria["nombre"] ?></option>
                        <?php } ?>
                    </select>
              </div>
              <div class="w-full">
                  <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                  <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5" required="">
              </div> 
              <div class="sm:col-span-2">
                  <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                  <input type="text" id="descripcion" name="descripcion" rows="2" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" ></input>
              </div>
          </div>
          <!-- Carga de archivos -->
            <div class="mt-6">
                <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900">Imagen del Producto</label>
                <input type="file" name="imagen" id="imagen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" required="">
            </div>
          <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 hover:bg-blue-800">
              Añadir producto
          </button>
      </form>
  </div>
</section>
