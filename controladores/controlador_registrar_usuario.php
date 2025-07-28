<?php
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bd = new BaseDeDatos();
    $conexion = $bd->conectar();

    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Seguridad
    $tipo_usuario = $_POST['tipo_usuario'];

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_completo, usuario, password, tipo_usuario) 
                            VALUES (:nombre, :usuario, :password, :tipo_usuario)");

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':tipo_usuario', $tipo_usuario);


    if ($stmt->execute()) {
        header("Location: ../vista/panel_admin.php?seccion=agregar_usuario&mensaje=✅ Usuario registrado correctamente");
        exit;
    } else {
        echo "❌ Error al registrar el usuario.";
    }
}
?>
