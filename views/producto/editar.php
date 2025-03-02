<div id="gestion_usuarios" class="p-6 bg-white rounded-lg shadow-md">

    <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>

    <form action="<?= URL_BASE ?>producto/update" method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="id" value="<?= $pro->id ?>" />

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" value="<?= $pro->nombre ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $pro->descripcion ?></textarea>
        </div>

        <div>
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" step="0.01" name="precio" value="<?= $pro->precio ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" value="<?= $pro->stock ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="categoria" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <?php foreach ($categorias as $cat) : ?>
                    <option value="<?= $cat->id ?>" <?= $cat->id == $pro->categoria_id ? 'selected' : '' ?>><?= $cat->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen Actual</label>
            <?php if (!empty($pro->imagen)) : ?>
                <img src="<?= URL_BASE ?>uploads/images/<?= $pro->imagen ?>" width="100" class="mt-2">
            <?php endif; ?>
        </div>

        <div>
            <label for="imagen" class="block text-sm font-medium text-gray-700">Cambiar Imagen</label>
            <input type="file" name="imagen" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
        </div>

        <div>
            <input type="submit" value="Actualizar" class="mt-4 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" />
        </div>
    </form>

</div>