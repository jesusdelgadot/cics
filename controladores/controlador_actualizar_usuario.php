<?php
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bd = new BaseDeDatos();
    $conexion = $bd->conectar();

    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $tipo_usuario = $_POST['tipo_usuario'];
    $nueva_contrasena = $_POST['nueva_contrasena'];

    if (!empty($nueva_contrasena)) {
        $hashed = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre_completo = :nombre, usuario = :usuario, password = :password, tipo_usuario = :tipo_usuario WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':password', $hashed);
    } else {
        $sql = "UPDATE usuarios SET nombre_completo = :nombre, usuario = :usuario, tipo_usuario = :tipo_usuario WHERE id = :id";
        $stmt = $conexion->prepare($sql);
    }

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: ../vista/panel_admin.php?seccion=ver_usuarios&mensaje=✅ Usuario actualizado");
        exit;
    } else {
        echo "❌ Error al actualizar.";
    }
}
?>
