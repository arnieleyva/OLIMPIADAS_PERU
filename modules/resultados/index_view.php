<?php

include '../../config/database.php';

$pageTitle = 'Resultados';
$pageHeading = 'Resultados y estadisticas';
$pageDescription = 'Consulta marcadores recientes, posiciones, goleadores y resumen general del campeonato.';
$activeMenu = 'resultados';

$totalPartidos = (int) $conexion->query('SELECT COUNT(*) FROM partidos')->fetchColumn();
$totalEquipos = (int) $conexion->query('SELECT COUNT(*) FROM equipos')->fetchColumn();
$totalResultados = (int) $conexion->query('SELECT COUNT(*) FROM resultados')->fetchColumn();
$totalJugadores = (int) $conexion->query('SELECT COUNT(*) FROM jugadores')->fetchColumn();

$datos = $conexion->query('
    SELECT
        r.id_resultado,
        e1.nombre AS local,
        e2.nombre AS visitante,
        r.marcador_local,
        r.marcador_visitante,
        r.ganador
    FROM resultados r
    INNER JOIN partidos p ON r.id_partido = p.id_partido
    INNER JOIN equipos e1 ON p.equipo_local = e1.id_equipo
    INNER JOIN equipos e2 ON p.equipo_visitante = e2.id_equipo
    ORDER BY r.id_resultado DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="metric-grid">
    <article class="metric-card metric-card--blue">
        <i class="fa-solid fa-futbol"></i>
        <h3><?= $totalPartidos ?></h3>
        <p>Partidos</p>
    </article>
    <article class="metric-card metric-card--green">
        <i class="fa-solid fa-shield-halved"></i>
        <h3><?= $totalEquipos ?></h3>
        <p>Equipos</p>
    </article>
    <article class="metric-card metric-card--amber">
        <i class="fa-solid fa-clipboard-list"></i>
        <h3><?= $totalResultados ?></h3>
        <p>Resultados</p>
    </article>
    <article class="metric-card metric-card--red">
        <i class="fa-solid fa-user-group"></i>
        <h3><?= $totalJugadores ?></h3>
        <p>Jugadores</p>
    </article>
</section>

<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Resultados registrados</h2>
            <p>Accede al historial de marcadores y navega a posiciones o goleadores.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo resultado
            </a>
            <a class="btn btn-primary" href="posiciones.php">
                <i class="fa-solid fa-ranking-star"></i>
                Posiciones
            </a>
            <a class="btn btn-secondary" href="goleadores.php">
                <i class="fa-solid fa-bullseye"></i>
                Goleadores
            </a>
            <a class="btn btn-secondary" href="cruces.php">
                <i class="fa-solid fa-diagram-project"></i>
                Llaves
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Partido</th>
                    <th>Marcador</th>
                    <th>Ganador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= e((string) $fila['id_resultado']) ?></td>
                        <td><?= e($fila['local']) ?> vs <?= e($fila['visitante']) ?></td>
                        <td><strong><?= e((string) $fila['marcador_local']) ?> - <?= e((string) $fila['marcador_visitante']) ?></strong></td>
                        <td><?= e((string) $fila['ganador']) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $fila['id_resultado']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este resultado?');">
                                    <input type="hidden" name="id" value="<?= e((string) $fila['id_resultado']) ?>">
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
