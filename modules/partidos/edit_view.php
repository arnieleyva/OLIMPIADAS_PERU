<?php

include '../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM partidos WHERE id_partido = ?');
$stmt->execute([$id]);
$partido = $stmt->fetch();

if (!$partido) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Editar partido';
$pageHeading = 'Actualizar partido';
$pageDescription = 'Ajusta evento, equipos, fecha, lugar o estado del encuentro seleccionado.';
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
            <h2>Partido #<?= e((string) $partido['id_partido']) ?></h2>
            <p>Actualiza la informacion programada del encuentro.</p>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $partido['id_partido']) ?>">

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="id_evento">Evento</label>
                <select id="id_evento" name="id_evento" required>
                    <?php foreach ($eventos as $evento): ?>
                        <option value="<?= e((string) $evento['id_evento']) ?>" <?= (int) $partido['id_evento'] === (int) $evento['id_evento'] ? 'selected' : '' ?>>
                            <?= e($evento['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="id_deporte">Deporte</label>
                <select id="id_deporte" name="id_deporte" required>
                    <?php foreach ($deportes as $deporte): ?>
                        <option value="<?= e((string) $deporte['id_deporte']) ?>" <?= (int) $partido['id_deporte'] === (int) $deporte['id_deporte'] ? 'selected' : '' ?>>
                            <?= e($deporte['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="equipo_local">Equipo local</label>
                <select id="equipo_local" name="equipo_local" required>
                    <?php foreach ($equipos as $equipo): ?>
                        <option value="<?= e((string) $equipo['id_equipo']) ?>" <?= (int) $partido['equipo_local'] === (int) $equipo['id_equipo'] ? 'selected' : '' ?>>
                            <?= e($equipo['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="equipo_visitante">Equipo visitante</label>
                <select id="equipo_visitante" name="equipo_visitante" required>
                    <?php foreach ($equipos as $equipo): ?>
                        <option value="<?= e((string) $equipo['id_equipo']) ?>" <?= (int) $partido['equipo_visitante'] === (int) $equipo['id_equipo'] ? 'selected' : '' ?>>
                            <?= e($equipo['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="fecha">Fecha y hora</label>
                <input id="fecha" type="datetime-local" name="fecha" value="<?= e(date('Y-m-d\TH:i', strtotime((string) $partido['fecha']))) ?>" required>
            </div>
            <div class="field">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <?php foreach (['Pendiente', 'Jugando', 'Finalizado'] as $estado): ?>
                        <option value="<?= e($estado) ?>" <?= $partido['estado'] === $estado ? 'selected' : '' ?>><?= e($estado) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="field">
            <label for="lugar">Lugar</label>
            <input id="lugar" type="text" name="lugar" value="<?= e((string) $partido['lugar']) ?>" required>
        </div>

        <div class="field">
            <label for="id_arbitro">Arbitro asignado</label>
            <select id="id_arbitro" name="id_arbitro">
                <option value="">Sin asignar</option>
                <?php foreach ($arbitros as $arbitro): ?>
                    <option value="<?= e((string) $arbitro['id_arbitro']) ?>" <?= (int) ($partido['id_arbitro'] ?? 0) === (int) $arbitro['id_arbitro'] ? 'selected' : '' ?>>
                        <?= e(trim((string) ($arbitro['nombres'] ?? '') . ' ' . (string) ($arbitro['apellidos'] ?? ''))) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar partido
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
