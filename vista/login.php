<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 1rem;
        }
        .logo {
            width: 100px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Tarjeta de login -->
            <div class="card shadow">
                <div class="card-body">
                    <img src="../img/LogoUMayor.jpg" alt="Logo" class="logo mb-3"> <!-- Puedes cambiar el logo -->
                    <h4 class="text-center mb-4">Iniciar Sesión</h4>

                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger text-center'>{$_GET['error']}</div>";
                    }
                    ?>

                    <form action="../controladores/controlador_login.php" method="POST">
                        <div class="mb-3">
                            <label for="tipo_usuario" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="" disabled selected>Seleccione tipo</option>
                                <option value="administrador">Administrador</option>
                                <option value="estandar">Usuario estándar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <!--<input type="email" class="form-control" id="correo" name="correo" required>-->
                            <input type="text" class="form-control" id="usuario" name="usuario" required>

                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
