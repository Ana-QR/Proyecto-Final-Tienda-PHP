<h1>Editar Usuario</h1>

<form action="<?= URL_BASE ?>usuario/actualizar" method="POST">
    <input type="hidden" name="id" value="<?= $usu->id ?>" />

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?= $usu->nombre ?>" required />

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" value="<?= $usu->apellidos ?>" required />

    <label for="email">Email</label>
    <input type="email" name="email" value="<?= $usu->email ?>" required />

    <label for="rol">Rol</label>
    <select name="rol">
        <option value="user" <?= $usu->rol == 'user' ? 'selected' : '' ?>>Usuario</option>
        <option value="admin" <?= $usu->rol == 'admin' ? 'selected' : '' ?>>Administrador</option>
    </select>

    <input type="submit" value="Guardar cambios" />
</form>