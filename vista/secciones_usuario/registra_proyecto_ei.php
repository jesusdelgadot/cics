<?php
require_once(__DIR__ . '/../../config/db.php');
$bd = new BaseDeDatos();
$conexion = $bd->conectar();

// Traer entidades y estados desde la BBDD
$entidades = $conexion->query("SELECT id, nombre FROM entidades")->fetchAll(PDO::FETCH_ASSOC);
$estados = $conexion->query("SELECT id, tipo_estado FROM estado_ie")->fetchAll(PDO::FETCH_ASSOC);
?>

<h3 class="text-primary mb-4">📋 Formulario de Proyecto IE</h3>

<form action="http://localhost/cics1/controladores/guarda_proyecto_ei.php" method="POST">

    <!-- Año -->
    <div class="mb-3">
        <label for="anio" class="form-label">Año:</label>
        <select name="anio" id="anio" class="form-select" required>
            <?php for ($year = 2015; $year <= 2030; $year++): ?>
                <option value="<?= $year ?>"><?= $year ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <!-- Entidad -->
    <div class="mb-3">
        <label for="entidad_id" class="form-label">Entidad:</label>
        <div class="input-group">
            <select name="entidad_id" id="entidad_id" class="form-select" required>
                <option value="">Seleccionar</option>
                <?php foreach ($entidades as $entidad): ?>
                    <option value="<?= $entidad['id'] ?>"><?= $entidad['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-outline-primary" type="button" onclick="mostrarCampoEntidad()">＋</button>
        </div>
    </div>

    <!-- Campo para agregar nueva entidad -->
    <div class="mb-3 d-none" id="campo_nueva_entidad">
        <label for="nueva_entidad" class="form-label">Agregar nueva entidad:</label>
        <input type="text" name="nueva_entidad" id="nueva_entidad" class="form-control">
    </div>

    <!-- Tipo de proyecto -->
    <div class="mb-3">
        <label for="tipo_proyecto" class="form-label">Tipo de Proyecto:</label>
        <input type="text" name="tipo_proyecto" id="tipo_proyecto" class="form-control" required>
    </div>

    <!-- Título propuesta -->
    <div class="mb-3">
        <label for="titulo_propuesta" class="form-label">Título Propuesta:</label>
        <input type="text" name="titulo_propuesta" id="titulo_propuesta" class="form-control" required>
    </div>

    <!-- Otras Entidades dinámicas -->
    <!-- Otras Entidades (selección múltiple con botón "+") -->
    <div class="mb-3">
        <label class="form-label">Otras Entidades:</label>
        <div id="contenedor-otras-entidades">
            <div class="input-group mb-2">
                <select name="otras_entidades[]" class="form-select">
                    <option value="">Seleccionar</option>
                    <?php foreach ($entidades as $entidad): ?>
                        <option value="<?= $entidad['id'] ?>"><?= $entidad['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-outline-danger" type="button" onclick="this.parentNode.remove()">🗑️</button>
            </div>
        </div>
        <button class="btn btn-outline-primary mt-1" type="button" onclick="agregarOtraEntidad()">＋ Agregar Otra Entidad</button>
    </div>


    <!-- Estado -->
    <div class="mb-3">
        <label for="estado_id" class="form-label">Estado:</label>
        <select name="estado_id" id="estado_id" class="form-select" required>
            <option value="">Seleccionar</option>
            <?php foreach ($estados as $estado): ?>
                <option value="<?= $estado['id'] ?>"><?= $estado['tipo_estado'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Botones -->
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="http://localhost/cics1/vista/panel_usuario.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
</form>

<!-- Scripts -->
<script>
function mostrarCampoEntidad() {
    document.getElementById("campo_nueva_entidad").classList.remove("d-none");
}

function agregarOtraEntidad() {
    const contenedor = document.getElementById("contenedor-otras-entidades");

    const nuevoCampo = document.createElement("div");
    nuevoCampo.className = "input-group mb-2";

    nuevoCampo.innerHTML = `
        <select name="otras_entidades[]" class="form-select">
            <option value="">Seleccionar</option>
            <?php foreach ($entidades as $entidad): ?>
                <option value="<?= $entidad['id'] ?>"><?= $entidad['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn btn-outline-danger" type="button" onclick="this.parentNode.remove()">🗑️</button>
    `;

    contenedor.appendChild(nuevoCampo);
}
</script>


