<?php

include '../../config/database.php';

$pageTitle = 'Partidos';
$pageHeading = 'Gestion de partidos';
$pageDescription = 'Consulta, programa y ajusta enfrentamientos del torneo con su estado actual.';
$activeMenu = 'partidos';

$partidos = $conexion->query('
    SELECT
        partidos.*,
        eventos.nombre AS evento,
        deportes.nombre AS deporte,
        CONCAT(COALESCE(arbitros.nombres, \'\'), \' \', COALESCE(arbitros.apellidos, \'\')) AS arbitro,
        local.nombre AS local_nombre,
        visitante.nombre AS visitante_nombre
    FROM partidos
    INNER JOIN eventos ON partidos.id_evento = eventos.id_evento
    INNER JOIN deportes ON partidos.id_deporte = deportes.id_deporte
    INNER JOIN equipos local ON partidos.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON partidos.equipo_visitante = visitante.id_equipo
    LEFT JOIN arbitros ON partidos.id_arbitro = arbitros.id_arbitro
    ORDER BY partidos.fecha DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Agenda de partidos</h2>
            <p>Programacion centralizada con evento, deporte, local, visitante y estado.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo partido
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Deporte</th>
                    <th>Encuentro</th>
                    <th>Arbitro</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partidos as $partido): ?>
                    <tr>
                        <td><?= e((string) $partido['id_partido']) ?></td>
                        <td><?= e($partido['evento']) ?></td>
                        <td><?= e($partido['deporte']) ?></td>
                        <td><?= e($partido['local_nombre']) ?> vs <?= e($partido['visitante_nombre']) ?></td>
                        <td><?= e(trim((string) $partido['arbitro']) ?: '-') ?></td>
                        <td><?= e((string) $partido['fecha']) ?></td>
                        <td><?= e((string) $partido['lugar']) ?></td>
                        <td><?= e((string) $partido['estado']) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $partido['id_partido']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este partido?');">
                                    <input type="hidden" name="id" value="<?= e((string) $partido['id_partido']) ?>">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require '../../includes/app_footer.php'; ?>
