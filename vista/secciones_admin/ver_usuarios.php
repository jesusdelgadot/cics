<?php
require_once(__DIR__ . '/../../config/db.php');

$bd = new BaseDeDatos();
$conexion = $bd->conectar();

$usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h3 class="text-primary mb-4">👥 Usuarios Registrados</h3>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nombre_completo']) ?></td>
            <td><?= htmlspecialchars($u['usuario']) ?></td>
            <td><?= htmlspecialchars($u['tipo_usuario']) ?></td>
            <td>
                <a href="panel_admin.php?seccion=editar_usuario&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning me-1">Editar</a>
                <a href="../controladores/controlador_eliminar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
