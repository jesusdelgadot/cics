<?php
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bd = new BaseDeDatos();
    $conexion = $bd->conectar();

    // 1. Recoger datos del formulario
    $anio = $_POST['anio'];
    $entidad_id = $_POST['entidad_id'];
    $tipo_proyecto = $_POST['tipo_proyecto'];
    $titulo_propuesta = $_POST['titulo_propuesta'];
    $estado_id = $_POST['estado_id'];

    // 2. Otras entidades (pueden ser varias, unidas en una cadena)
    $otras_entidades_array = $_POST['otras_entidades'] ?? [];
    $otras_entidades = implode(', ', $otras_entidades_array); // Convertir a texto separado por comas

    // 3. Si se agregó una nueva entidad personalizada
    if (!empty($_POST['nueva_entidad'])) {
        $nuevaEntidad = trim($_POST['nueva_entidad']);
        // Insertar nueva entidad en la tabla
        $stmt = $conexion->prepare("INSERT INTO entidades (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nuevaEntidad);
        $stmt->execute();
        $entidad_id = $conexion->lastInsertId(); // Actualizar entidad_id con la nueva entidad
    }

    // 4. Insertar proyecto
    $stmt = $conexion->prepare("INSERT INTO proyectos_ie (anio, entidad_id, tipo_proyecto, titulo_propuesta, otras_entidades, estado_id)
                                VALUES (:anio, :entidad_id, :tipo_proyecto, :titulo_propuesta, :otras_entidades, :estado_id)");
    $stmt->bindParam(':anio', $anio);
    $stmt->bindParam(':entidad_id', $entidad_id);
    $stmt->bindParam(':tipo_proyecto', $tipo_proyecto);
    $stmt->bindParam(':titulo_propuesta', $titulo_propuesta);
    $stmt->bindParam(':otras_entidades', $otras_entidades);
    $stmt->bindParam(':estado_id', $estado_id);

    if ($stmt->execute()) {
        header("Location: ../vista/panel_usuario.php?seccion=registro&mensaje=✅ Proyecto registrado correctamente");
        exit;
    } else {
        echo "❌ Error al guardar el proyecto.";
    }
}
?>
