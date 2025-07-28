<?php
session_start(); // Iniciar sesión

require_once(__DIR__ . '/../config/db.php'); // Conexión a la BBDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Obtener datos del formulario
    $usuario_input = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario_form = $_POST['tipo_usuario']; // administrador o estandar

    // 2. Conexión a la base de datos
    $bd = new BaseDeDatos();
    $conexion = $bd->conectar();

    // 3. Buscar el usuario
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $consulta->bindParam(':usuario', $usuario_input);
    $consulta->execute();

    if ($consulta->rowCount() === 1) {
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        // 4. Verificar contraseña y tipo
        if (password_verify($contrasena, $usuario['password'])) {
            if ($usuario['tipo_usuario'] === $tipo_usuario_form) {
                // 5. Guardar datos en sesión
                $_SESSION['usuario'] = $usuario['usuario'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                $_SESSION['nombre'] = $usuario['nombre_completo'];

                // 6. Redirigir según el tipo
                if ($usuario['tipo_usuario'] === 'administrador') {
                    header("Location: ../vista/panel_admin.php");
                } else {
                    header("Location: ../vista/panel_usuario.php");
                }
                exit;
            } else {
                header("Location: ../vista/login.php?error=⚠️ Tipo de usuario incorrecto");
                exit;
            }
        } else {
            header("Location: ../vista/login.php?error=❌ Contraseña incorrecta");
            exit;
        }
    } else {
        header("Location: ../vista/login.php?error=❌ Usuario no registrado");
        exit;
    }
} else {
    header("Location: ../vista/login.php");
    exit;
}
?>
