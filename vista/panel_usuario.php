<?php
session_start();

// Seguridad: solo usuarios tipo 'estandar'
if (!isset($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'estandar') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- 🔷 Parte superior -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Panel Usuario</span>
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
                <a href="?seccion=registrar_proyecto" class="list-group-item list-group-item-action">📝 Registrar Proyecto</a>
                <a href="?seccion=ver_proyectos" class="list-group-item list-group-item-action">📄 Ver Proyectos</a>
            </div>
        </div>

        <!-- Columna derecha: Contenido dinámico -->
        <div class="col-md-9">
            <?php
            if (isset($_GET['seccion'])) {
                $seccion = $_GET['seccion'];
                if ($seccion === 'registrar_proyecto') {
                    include 'secciones_usuario/registra_proyecto_ei.php';}
                elseif ($seccion === 'ver_proyectos') {
                     include 'secciones_usuario/ver_proyectos_ei.php';}
                else {
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
    <p class="mb-0">© 2025 - Panel de Usuario CICS</p>
</footer>

</body>
</html>

