<?php
require_once(__DIR__ . '/../../config/db.php');
$bd = new BaseDeDatos();
$conexion = $bd->conectar();

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID no especificado.</div>";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<div class='alert alert-warning'>Usuario no encontrado.</div>";
    exit;
}
?>

<h3 class="text-primary mb-4">✏️ Editar Usuario</h3>

<form action="../controladores/controlador_actualizar_usuario.php" method="POST">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre_completo']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario (correo o nombre de usuario):</label>
        <input type="text" name="usuario" id="usuario" class="form-control" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="nueva_contrasena" class="form-label">Nueva contraseña (opcional):</label>
        <input type="password" name="nueva_contrasena" id="nueva_contrasena" class="form-control">
    </div>

    <div class="mb-3">
        <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
        <select name="tipo_usuario" id="tipo_usuario" class="form-select" required>
            <option value="administrador" <?= $usuario['tipo_usuario'] === 'administrador' ? 'selected' : '' ?>>Administrador</option>
            <option value="estandar" <?= $usuario['tipo_usuario'] === 'estandar' ? 'selected' : '' ?>>Estandar</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar Cambios</button>
    <a href="panel_admin.php?seccion=ver_usuarios" class="btn btn-secondary">Cancelar</a>
</form>
