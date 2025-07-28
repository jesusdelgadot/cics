<?php
require_once(__DIR__ . '/../../config/db.php');

$bd = new BaseDeDatos();
$conexion = $bd->conectar();

// Inserción de nuevo estado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_estado'])) {
    $nuevo_estado = trim($_POST['nuevo_estado']);

    if (!empty($nuevo_estado)) {
        $stmt = $conexion->prepare("INSERT INTO estado_ie (tipo_estado) VALUES (:estado)");
        $stmt->bindParam(':estado', $nuevo_estado);
        $stmt->execute();
        header("Location: panel_admin.php?seccion=estado&mensaje=✅ Estado agregado correctamente");
        exit;
    }
}

// Eliminación de estado
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $stmt = $conexion->prepare("DELETE FROM estado_ie WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: panel_admin.php?seccion=estado&mensaje=🗑️ Estado eliminado");
    exit;
}

// Obtener todos los estados
$consulta = $conexion->query("SELECT * FROM estado_ie");
$estados = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<h3 class="mt-4">➕ Agregar nuevo estado</h3>

<form method="POST" class="mb-4">
    <div class="mb-3">
        <label for="nuevo_estado" class="form-label">Nombre del estado</label>
        <input type="text" name="nuevo_estado" id="nuevo_estado" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

<hr>

<h4>📋 Estados registrados</h4>

<?php if (count($estados) === 0): ?>
    <p>No hay estados registrados.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tipo de Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estados as $estado): ?>
                <tr>
                    <td><?= $estado['id'] ?></td>
                    <td><?= htmlspecialchars($estado['tipo_estado']) ?></td>
                    <td>
                        <a href="panel_admin.php?seccion=estado&eliminar=<?= $estado['id'] ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('¿Estás seguro de eliminar este estado?')">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
