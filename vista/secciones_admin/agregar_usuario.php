<h3 class="text-primary mb-4">👤 Registro de Nuevo Usuario</h3>

<form action="http://localhost/cics1/controladores/controlador_registrar_usuario.php" method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario (correo o nombre de usuario):</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
        <select name="tipo_usuario" id="tipo_usuario" class="form-select" required>
            <option value="">Seleccionar</option>
            <option value="administrador">Administrador</option>
            <option value="estandar">Estándar</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Registrar Usuario</button>
</form>
