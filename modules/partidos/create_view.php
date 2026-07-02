<?php

include '../../config/database.php';

$pageTitle = 'Nuevo partido';
$pageHeading = 'Programar partido';
$pageDescription = 'Selecciona evento, disciplina y equipos para registrar un nuevo encuentro.';
$activeMenu = 'partidos';

$equipos = $conexion->query('SELECT * FROM equipos ORDER BY nombre')->fetchAll();
$eventos = $conexion->query('SELECT * FROM eventos ORDER BY fecha_inicio DESC')->fetchAll();
$deportes = $conexion->query('SELECT * FROM deportes ORDER BY nombre')->fetchAll();
$arbitros = $conexion->query('SELECT * FROM arbitros ORDER BY nombres, apellidos')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Datos del encuentro</h2>
            <p>Procura no repetir equipos y verifica la fecha antes de guardar.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_evento">Evento</label>
                <select id="id_evento" name="id_evento" required>
                    <?php foreach ($eventos as $evento): ?>
                        <option value="<?= e((string) $evento['id_evento']) ?>"><?= e($evento['nombre']) ?></option>
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
                <label for="equipo_local">Equipo local</label>
                <select id="equipo_local" name="equipo_local" required>
                    <?php foreach ($equipos as $equipo): ?>
                        <option value="<?= e((string) $equipo['id_equipo']) ?>"><?= e($equipo['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="equipo_visitante">Equipo visitante</label>
                <select id="equipo_visitante" name="equipo_visitante" required>
                    <?php foreach ($equipos as $equipo): ?>
                        <option value="<?= e((string) $equipo['id_equipo']) ?>"><?= e($equipo['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="fecha">Fecha y hora</label>
                <input id="fecha" type="datetime-local" name="fecha" required>
            </div>
            <div class="field">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Jugando">Jugando</option>
                    <option value="Finalizado">Finalizado</option>
                </select>
            </div>
        </div>

        <div class="field">
            <label for="id_arbitro">Arbitro asignado</label>
            <select id="id_arbitro" name="id_arbitro">
                <option value="">Sin asignar</option>
                <?php foreach ($arbitros as $arbitro): ?>
                    <option value="<?= e((string) $arbitro['id_arbitro']) ?>">
                        <?= e(trim((string) ($arbitro['nombres'] ?? '') . ' ' . (string) ($arbitro['apellidos'] ?? ''))) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="lugar">Lugar</label>
            <input id="lugar" type="text" name="lugar" required>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar partido
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
