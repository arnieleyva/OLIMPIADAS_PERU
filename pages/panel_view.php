<?php

include dirname(__DIR__) . '/config/database.php';

$pageTitle = 'Panel principal';
$pageHeading = 'Centro de control del campeonato';
$pageDescription = 'Monitorea participantes, partidos programados, resultados y acceso rapido a cada modulo operativo.';
$activeMenu = 'panel';
$pageContentClass = 'app-content--dashboard';

$totalUsuarios = (int) $conexion->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
$totalEquipos = (int) $conexion->query('SELECT COUNT(*) FROM equipos')->fetchColumn();
$totalDeportes = (int) $conexion->query('SELECT COUNT(*) FROM deportes')->fetchColumn();
$totalPartidos = (int) $conexion->query('SELECT COUNT(*) FROM partidos')->fetchColumn();
$totalResultados = (int) $conexion->query('SELECT COUNT(*) FROM resultados')->fetchColumn();
$partidosPendientes = (int) $conexion->query("SELECT COUNT(*) FROM partidos WHERE estado = 'Pendiente'")->fetchColumn();
$totalInstituciones = (int) $conexion->query('SELECT COUNT(*) FROM instituciones')->fetchColumn();
$totalEventos = (int) $conexion->query('SELECT COUNT(*) FROM eventos')->fetchColumn();
$totalArbitros = (int) $conexion->query('SELECT COUNT(*) FROM arbitros')->fetchColumn();
$totalNotificaciones = (int) $conexion->query('SELECT COUNT(*) FROM notificaciones')->fetchColumn();

$ultimosPartidos = $conexion->query("
    SELECT
        p.fecha,
        p.lugar,
        p.estado,
        local.nombre AS local_nombre,
        visitante.nombre AS visitante_nombre
    FROM partidos p
    INNER JOIN equipos local ON p.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON p.equipo_visitante = visitante.id_equipo
    ORDER BY p.fecha DESC
    LIMIT 5
")->fetchAll();

$ultimosResultados = $conexion->query("
    SELECT
        r.id_resultado,
        local.nombre AS local_nombre,
        visitante.nombre AS visitante_nombre,
        r.marcador_local,
        r.marcador_visitante,
        r.ganador
    FROM resultados r
    INNER JOIN partidos p ON r.id_partido = p.id_partido
    INNER JOIN equipos local ON p.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON p.equipo_visitante = visitante.id_equipo
    ORDER BY r.id_resultado DESC
    LIMIT 5
")->fetchAll();

require dirname(__DIR__) . '/includes/app_header.php';
?>
<section class="hero-card">
    <div class="eyebrow">Vista general</div>
    <h2>Operacion central de Olimpiadas Peru</h2>
    <p>
        Desde este panel puedes revisar el avance del campeonato, registrar nuevos equipos,
        programar partidos, cargar resultados y mantener la informacion lista para la presentacion del curso.
    </p>
    <div class="actions" style="margin-top:18px;">
        <a class="btn btn-primary" href="<?= e(app_url('modules/partidos/index.php')) ?>">
            <i class="fa-regular fa-calendar"></i>
            Ver programacion
        </a>
        <a class="btn btn-success" href="<?= e(app_url('modules/resultados/index.php')) ?>">
            <i class="fa-solid fa-chart-line"></i>
            Revisar resultados
        </a>
        <a class="btn btn-secondary" href="<?= e(app_url('modules/equipos/index.php')) ?>">
            <i class="fa-solid fa-shield-halved"></i>
            Gestionar equipos
        </a>
    </div>
</section>

<section class="metric-grid">
    <article class="metric-card metric-card--blue">
        <i class="fa-solid fa-users"></i>
        <h3><?= $totalUsuarios ?></h3>
        <p>Usuarios registrados</p>
    </article>
    <article class="metric-card metric-card--green">
        <i class="fa-solid fa-shield-halved"></i>
        <h3><?= $totalEquipos ?></h3>
        <p>Equipos activos</p>
    </article>
    <article class="metric-card metric-card--amber">
        <i class="fa-solid fa-volleyball"></i>
        <h3><?= $totalDeportes ?></h3>
        <p>Disciplinas disponibles</p>
    </article>
    <article class="metric-card metric-card--red">
        <i class="fa-regular fa-calendar"></i>
        <h3><?= $totalPartidos ?></h3>
        <p>Partidos registrados</p>
    </article>
    <article class="metric-card metric-card--violet">
        <i class="fa-solid fa-trophy"></i>
        <h3><?= $totalResultados ?></h3>
        <p>Resultados cargados</p>
    </article>
    <article class="metric-card metric-card--blue">
        <i class="fa-solid fa-hourglass-half"></i>
        <h3><?= $partidosPendientes ?></h3>
        <p>Partidos pendientes</p>
    </article>
    <article class="metric-card metric-card--green">
        <i class="fa-solid fa-building-columns"></i>
        <h3><?= $totalInstituciones ?></h3>
        <p>Instituciones</p>
    </article>
    <article class="metric-card metric-card--amber">
        <i class="fa-solid fa-flag-checkered"></i>
        <h3><?= $totalEventos ?></h3>
        <p>Eventos activos</p>
    </article>
    <article class="metric-card metric-card--red">
        <i class="fa-solid fa-user-tie"></i>
        <h3><?= $totalArbitros ?></h3>
        <p>Arbitros</p>
    </article>
    <article class="metric-card metric-card--violet">
        <i class="fa-solid fa-bell"></i>
        <h3><?= $totalNotificaciones ?></h3>
        <p>Notificaciones</p>
    </article>
</section>

<section class="feature-grid">
    <article class="mini-card">
        <h3>Administracion del torneo</h3>
        <p>Controla entidades base para que el sistema se sienta completo y listo para exposición.</p>
        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(app_url('modules/instituciones/index.php')) ?>">Instituciones</a>
            <a class="btn btn-secondary" href="<?= e(app_url('modules/eventos/index.php')) ?>">Eventos</a>
            <a class="btn btn-secondary" href="<?= e(app_url('modules/arbitros/index.php')) ?>">Arbitros</a>
        </div>
    </article>

    <article class="mini-card">
        <h3>Comunicacion y salidas</h3>
        <p>Lleva seguimiento de mensajes enviados y genera archivos exportables para mostrar evidencia.</p>
        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(app_url('modules/notificaciones/index.php')) ?>">Historial</a>
            <a class="btn btn-secondary" href="<?= e(app_url('modules/reportes/index.php')) ?>">Reportes</a>
        </div>
    </article>
    <article class="mini-card">
        <h3>Resumen operativo</h3>
        <div class="stat-list">
            <div class="stat-list__row"><span>Instituciones</span><strong><?= $totalInstituciones ?></strong></div>
            <div class="stat-list__row"><span>Eventos</span><strong><?= $totalEventos ?></strong></div>
            <div class="stat-list__row"><span>Arbitros</span><strong><?= $totalArbitros ?></strong></div>
            <div class="stat-list__row"><span>Notificaciones</span><strong><?= $totalNotificaciones ?></strong></div>
        </div>
    </article>
</section>

<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Ultimos partidos registrados</h2>
            <p>Seguimiento rapido de la agenda competitiva.</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="<?= e(app_url('modules/partidos/crear.php')) ?>">
                <i class="fa-solid fa-plus"></i>
                Nuevo partido
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Encuentro</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ultimosPartidos === []): ?>
                    <tr>
                        <td colspan="4" class="empty-state">Aun no hay partidos registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($ultimosPartidos as $partido): ?>
                        <tr>
                            <td><strong><?= e($partido['local_nombre']) ?></strong> vs <?= e($partido['visitante_nombre']) ?></td>
                            <td><?= e((string) $partido['fecha']) ?></td>
                            <td><?= e((string) $partido['lugar']) ?></td>
                            <td><?= e((string) $partido['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Resultados recientes</h2>
            <p>Resumen de marcadores cargados al sistema.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="<?= e(app_url('modules/resultados/crear.php')) ?>">
                <i class="fa-solid fa-plus"></i>
                Registrar resultado
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Partido</th>
                    <th>Marcador</th>
                    <th>Ganador</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ultimosResultados === []): ?>
                    <tr>
                        <td colspan="3" class="empty-state">Todavia no se han cargado resultados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($ultimosResultados as $resultado): ?>
                        <tr>
                            <td><?= e($resultado['local_nombre']) ?> vs <?= e($resultado['visitante_nombre']) ?></td>
                            <td><strong><?= e((string) $resultado['marcador_local']) ?> - <?= e((string) $resultado['marcador_visitante']) ?></strong></td>
                            <td><?= e((string) $resultado['ganador']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require dirname(__DIR__) . '/includes/app_footer.php'; ?>
