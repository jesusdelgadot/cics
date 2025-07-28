<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

// Solo permitir si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ../vista/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_estado = $_POST['tipo_estado'];

    try {
        $bd = new BaseDeDatos();
        $conexion = $bd->conectar();

        $sql = "INSERT INTO estado_ie (tipo_estado) VALUES (:tipo_estado)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':tipo_estado', $tipo_estado);
        $stmt->execute();

        header("Location: ../vista/panel_admin.php?seccion=agregar_estado&mensaje=✅ Estado agregado correctamente");
        exit;
    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
}
?>

