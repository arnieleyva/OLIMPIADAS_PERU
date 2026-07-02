<?php

include '../../config/database.php';

$pageTitle = 'Nuevo equipo';
$pageHeading = 'Registrar equipo';
$pageDescription = 'Completa institucion, categoria, capitan y datos deportivos del nuevo registro.';
$activeMenu = 'equipos';

$deportes = $conexion->query('SELECT * FROM deportes ORDER BY nombre')->fetchAll();
$instituciones = $conexion->query('SELECT * FROM instituciones ORDER BY nombre')->fetchAll();
$categorias = $conexion->query('SELECT * FROM categorias ORDER BY id_categoria')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Datos del equipo</h2>
            <p>Esta informacion tambien alimenta la programacion y las notificaciones por WhatsApp.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombre">Nombre del equipo</label>
                <input id="nombre" type="text" name="nombre" required>
            </div>
            <div class="field">
                <label for="director_tecnico">Director tecnico</label>
                <input id="director_tecnico" type="text" name="director_tecnico">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_institucion">Institucion</label>
                <select id="id_institucion" name="id_institucion" required>
                    <?php foreach ($instituciones as $institucion): ?>
                        <option value="<?= e((string) $institucion['id_institucion']) ?>"><?= e($institucion['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="id_deporte">Deporte</label>
                <select id="id_deporte" name="id_deporte" required>
                    <?php foreach ($deportes as $deporte): ?>
                        <option value="<?= e((string) $deporte['id_deporte']) ?>"><?= e($deporte['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_categoria">Categoria</label>
                <select id="id_categoria" name="id_categoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= e((string) $categoria['id_categoria']) ?>"><?= e($categoria['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="capitan">Capitan</label>
                <input id="capitan" type="text" name="capitan">
            </div>
        </div>

        <div class="field">
            <label for="telefono_capitan">Telefono del capitan</label>
            <input id="telefono_capitan" type="text" name="telefono_capitan" placeholder="Solo numeros, ej. 999888777">
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar equipo
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
