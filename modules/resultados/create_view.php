<?php

include '../../config/database.php';

$pageTitle = 'Nuevo resultado';
$pageHeading = 'Registrar resultado';
$pageDescription = 'Carga el marcador final y observaciones del partido seleccionado.';
$activeMenu = 'resultados';

$partidos = $conexion->query('
    SELECT
        p.id_partido,
        local.nombre AS local,
        visitante.nombre AS visitante,
        p.fecha
    FROM partidos p
    INNER JOIN equipos local ON p.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON p.equipo_visitante = visitante.id_equipo
    ORDER BY p.fecha DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Marcador del partido</h2>
            <p>El resultado quedara disponible para posiciones, estadisticas y panel principal.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="field">
            <label for="id_partido">Partido</label>
            <select id="id_partido" name="id_partido" required>
                <?php foreach ($partidos as $partido): ?>
                    <option value="<?= e((string) $partido['id_partido']) ?>">
                        <?= e($partido['local']) ?> vs <?= e($partido['visitante']) ?> | <?= e((string) $partido['fecha']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="marcador_local">Marcador local</label>
                <input id="marcador_local" type="number" name="marcador_local" min="0" required>
            </div>
            <div class="field">
                <label for="marcador_visitante">Marcador visitante</label>
                <input id="marcador_visitante" type="number" name="marcador_visitante" min="0" required>
            </div>
        </div>

        <div class="field">
            <label for="observaciones">Observaciones</label>
            <input id="observaciones" type="text" name="observaciones">
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar resultado
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
