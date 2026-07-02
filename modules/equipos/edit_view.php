<?php

include '../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM equipos WHERE id_equipo = ?');
$stmt->execute([$id]);
$equipo = $stmt->fetch();

if (!$equipo) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Editar equipo';
$pageHeading = 'Actualizar equipo';
$pageDescription = 'Modifica la informacion institucional y de contacto del equipo seleccionado.';
$activeMenu = 'equipos';

$deportes = $conexion->query('SELECT * FROM deportes ORDER BY nombre')->fetchAll();
$instituciones = $conexion->query('SELECT * FROM instituciones ORDER BY nombre')->fetchAll();
$categorias = $conexion->query('SELECT * FROM categorias ORDER BY id_categoria')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2><?= e($equipo['nombre']) ?></h2>
            <p>Actualiza datos generales, responsables y categoria del equipo.</p>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $equipo['id_equipo']) ?>">

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombre">Nombre del equipo</label>
                <input id="nombre" type="text" name="nombre" value="<?= e($equipo['nombre']) ?>" required>
            </div>
            <div class="field">
                <label for="director_tecnico">Director tecnico</label>
                <input id="director_tecnico" type="text" name="director_tecnico" value="<?= e((string) ($equipo['director_tecnico'] ?? '')) ?>">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_institucion">Institucion</label>
                <select id="id_institucion" name="id_institucion" required>
                    <?php foreach ($instituciones as $institucion): ?>
                        <option value="<?= e((string) $institucion['id_institucion']) ?>" <?= (int) $equipo['id_institucion'] === (int) $institucion['id_institucion'] ? 'selected' : '' ?>>
                            <?= e($institucion['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="id_deporte">Deporte</label>
                <select id="id_deporte" name="id_deporte" required>
                    <?php foreach ($deportes as $deporte): ?>
                        <option value="<?= e((string) $deporte['id_deporte']) ?>" <?= (int) $equipo['id_deporte'] === (int) $deporte['id_deporte'] ? 'selected' : '' ?>>
                            <?= e($deporte['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_categoria">Categoria</label>
                <select id="id_categoria" name="id_categoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= e((string) $categoria['id_categoria']) ?>" <?= (int) $equipo['id_categoria'] === (int) $categoria['id_categoria'] ? 'selected' : '' ?>>
                            <?= e($categoria['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="capitan">Capitan</label>
                <input id="capitan" type="text" name="capitan" value="<?= e((string) ($equipo['capitan'] ?? '')) ?>">
            </div>
        </div>

        <div class="field">
            <label for="telefono_capitan">Telefono del capitan</label>
            <input id="telefono_capitan" type="text" name="telefono_capitan" value="<?= e((string) ($equipo['telefono_capitan'] ?? '')) ?>">
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar equipo
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
