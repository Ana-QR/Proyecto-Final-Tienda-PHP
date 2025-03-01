<?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'correcto') : ?>
    <strong class="text-green-500">Categoría creada correctamente</strong>

<?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'incorrecto') : ?>
    <strong class="text-red-500">Error al crear la categoría</strong>
<?php endif; ?>
<?php Utils::borrarSesion('categoria'); ?>

<h2 class="text-lg font-semibold">Crear nueva categoría</h2>
<form action="<?= URL_BASE ?>categoria/guardar" method="POST">
    <label for="nombre" class="block">Nombre de la categoría</label>
    <input type="text" name="nombre" required class="border p-2 rounded">
    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Guardar</button>
</form>

?>