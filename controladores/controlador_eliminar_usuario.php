<?php
require_once(__DIR__ . '/../config/db.php');

if (isset($_GET['id'])) {
    $bd = new BaseDeDatos();
    $conexion = $bd->conectar();

    $id = $_GET['id'];

    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: ../vista/panel_admin.php?seccion=ver_usuarios&mensaje=✅ Usuario eliminado correctamente");
        exit;
    } else {
        echo "❌ Error al eliminar el usuario.";
    }
} else {
    echo "❌ ID no proporcionado.";
}

