<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- 🔷 Parte superior -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Panel Administrador</span>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                👤 <?= $_SESSION['nombre']; ?> (<?= $_SESSION['usuario']; ?>)
            </span>
            <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</nav>

<!-- 🟦 Parte media: dos columnas -->
<div class="container-fluid mt-3">
    <div class="row">

        <!-- Columna izquierda: Menú -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="?seccion=estado" class="list-group-item list-group-item-action">➕ Agregar Estado</a>
                <a href="?seccion=entidad" class="list-group-item list-group-item-action">🏢 Agregar Entidad</a>
                <a href="?seccion=ver_proyectos" class="list-group-item list-group-item-action">📋 Ver Proyectos</a>
                <a href="?seccion=agregar_usuario" class="list-group-item list-group-item-action">👤 Agregar Usuario</a>
                <a href="?seccion=ver_usuarios" class="list-group-item list-group-item-action">👥 Ver Usuarios</a>
            </div>
        </div>

        <!-- Columna derecha: Contenido dinámico -->
        <div class="col-md-9">
            <?php if (isset($_GET['mensaje'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
            <?php endif; ?>

            <?php
            if (isset($_GET['seccion'])) {
                $seccion = $_GET['seccion'];
                if ($seccion === 'estado') {
                    include 'secciones_admin/agregar_estado_ei.php';
                } elseif ($seccion === 'entidad') {
                    include 'secciones_admin/agregar_entidad.php';
                } elseif ($seccion === 'ver_proyectos') {
                    include 'secciones_usuario/ver_proyectos_ei.php';
                } elseif ($seccion === 'agregar_usuario') {
                    include 'secciones_admin/agregar_usuario.php';
                } elseif ($seccion === 'ver_usuarios') {
                    include 'secciones_admin/ver_usuarios.php';
                }elseif ($seccion === 'editar_usuario') {
                    include 'secciones_admin/editar_usuario.php';
                } else {
                    echo "<div class='alert alert-warning'>Sección no encontrada.</div>";
                }
            } else {
                echo "<div class='alert alert-info'>Selecciona una opción del menú.</div>";
            }
            ?>
        </div>
    </div>
</div>

<!-- 🔻 Footer -->
<footer class="bg-dark text-white text-center mt-5 py-3">
    <p class="mb-0">© 2025 - Panel de Administración CICS</p>
</footer>

</body>
</html>


