<?php

include '../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    header('Location: index.php');
    exit();
}

$roles = $conexion->query('SELECT * FROM roles ORDER BY id_rol')->fetchAll();

$pageTitle = 'Editar usuario';
$pageHeading = 'Actualizar usuario';
$pageDescription = 'Modifica datos de acceso, informacion personal y rol asignado.';
$activeMenu = 'usuarios';

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2><?= e(trim($usuario['nombre'] . ' ' . $usuario['apellido'])) ?></h2>
            <p>Actualiza la informacion del usuario seleccionado.</p>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $usuario['id_usuario']) ?>">

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" value="<?= e($usuario['nombre']) ?>" required>
            </div>
            <div class="field">
                <label for="apellido">Apellido</label>
                <input id="apellido" type="text" name="apellido" value="<?= e($usuario['apellido']) ?>" required>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="email">Correo</label>
                <input id="email" type="email" name="email" value="<?= e($usuario['email']) ?>" required>
            </div>
            <div class="field">
                <label for="telefono">Telefono</label>
                <input id="telefono" type="text" name="telefono" value="<?= e((string) ($usuario['telefono'] ?? '')) ?>">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="password">Nueva contrasena</label>
                <input id="password" type="password" name="password" placeholder="Opcional">
            </div>
            <div class="field">
                <label for="id_rol">Rol</label>
                <select id="id_rol" name="id_rol" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= e((string) $rol['id_rol']) ?>" <?= (int) $usuario['id_rol'] === (int) $rol['id_rol'] ? 'selected' : '' ?>>
                            <?= e($rol['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar usuario
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
