<?php

include '../../config/database.php';

$pageTitle = 'Nuevo usuario';
$pageHeading = 'Registrar usuario';
$pageDescription = 'Crea una cuenta administrativa o institucional para operar dentro del sistema.';
$activeMenu = 'usuarios';

$roles = $conexion->query('SELECT * FROM roles ORDER BY id_rol')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Datos del usuario</h2>
            <p>Completa la informacion principal para generar el acceso.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" required>
            </div>
            <div class="field">
                <label for="apellido">Apellido</label>
                <input id="apellido" type="text" name="apellido" required>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="email">Correo</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field">
                <label for="telefono">Telefono</label>
                <input id="telefono" type="text" name="telefono">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="password">Contrasena</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="field">
                <label for="id_rol">Rol</label>
                <select id="id_rol" name="id_rol" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= e((string) $rol['id_rol']) ?>"><?= e($rol['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar usuario
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
