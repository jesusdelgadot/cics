<?php
require_once(__DIR__ . '/../../config/db.php');

$bd = new BaseDeDatos();
$conexion = $bd->conectar();

// Consulta con JOIN para mostrar nombres legibles
$sql = "SELECT p.*, 
               e.nombre AS nombre_entidad,
               s.tipo_estado AS nombre_estado
        FROM proyectos_ie p
        LEFT JOIN entidades e ON p.entidad_id = e.id
        LEFT JOIN estado_ie s ON p.estado_id = s.id
        ORDER BY p.fecha_registro DESC";

$proyectos = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<h3 class="text-primary mb-4">📑 Proyectos Registrados</h3>

<?php if (count($proyectos) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-sm align-middle small">

            <thead class="table-dark">
                <tr>
                    <th>Año</th>
                    <th>Entidad</th>
                    <th>Tipo Proyecto</th>
                    <th>Título</th>
                    <th>Otras Entidades</th>
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['anio']) ?></td>
                        <td><?= htmlspecialchars($p['nombre_entidad']) ?></td>
                        <td><?= htmlspecialchars($p['tipo_proyecto']) ?></td>
                        <td><?= htmlspecialchars($p['titulo_propuesta']) ?></td>
                        <td><?= htmlspecialchars($p['otras_entidades']) ?></td>
                        <td><?= htmlspecialchars($p['nombre_estado']) ?></td>
                        <td><?= htmlspecialchars($p['fecha_registro']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info">No hay proyectos registrados.</div>
<?php endif; ?>
