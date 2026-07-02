<?php

include '../../config/database.php';

$pageTitle = 'Goleadores';
$pageHeading = 'Top de goleadores';
$pageDescription = 'Resumen estadistico de los jugadores con mayor cantidad de goles registrados.';
$activeMenu = 'resultados';

$datos = $conexion->query('
    SELECT
        j.nombres,
        j.apellidos,
        e.nombre AS equipo,
        es.goles
    FROM estadisticas es
    INNER JOIN jugadores j ON es.id_jugador = j.id_jugador
    INNER JOIN equipos e ON j.id_equipo = e.id_equipo
    ORDER BY es.goles DESC
    LIMIT 10
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Tabla de goleadores</h2>
            <p>Ranking de jugadores con mayor produccion ofensiva en el campeonato.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Jugador</th>
                    <th>Equipo</th>
                    <th>Goles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= e($fila['nombres'] . ' ' . $fila['apellidos']) ?></td>
                        <td><?= e($fila['equipo']) ?></td>
                        <td><strong><?= e((string) $fila['goles']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require '../../includes/app_footer.php'; ?>
