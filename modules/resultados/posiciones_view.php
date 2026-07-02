<?php
include '../../config/database.php';
$pageTitle = 'Tabla de posiciones';
$pageHeading = 'Posiciones del campeonato';
$pageDescription = 'Resumen consolidado de puntos, victorias y diferencia de goles por equipo.';
$activeMenu = 'resultados';
$datos = $conexion->query('SELECT * FROM vw_tabla_posiciones ORDER BY PTS DESC, DG DESC, GF DESC, nombre ASC')->fetchAll();
require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title"><h2>Tabla general</h2><p>Clasificacion actual basada en resultados registrados.</p></div>
        <div class="actions"><a class="btn btn-secondary" href="cruces.php"><i class="fa-solid fa-diagram-project"></i> Ver llaves</a></div>
    </div>
    <div class="table-responsive">
        <table class="app-table">
            <thead><tr><th>Equipo</th><th>PJ</th><th>PG</th><th>PE</th><th>PP</th><th>GF</th><th>GC</th><th>DG</th><th>PTS</th></tr></thead>
            <tbody>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= e($fila['nombre']) ?></td>
                        <td><?= e((string) $fila['PJ']) ?></td>
                        <td><?= e((string) $fila['PG']) ?></td>
                        <td><?= e((string) $fila['PE']) ?></td>
                        <td><?= e((string) $fila['PP']) ?></td>
                        <td><?= e((string) $fila['GF']) ?></td>
                        <td><?= e((string) $fila['GC']) ?></td>
                        <td><?= e((string) $fila['DG']) ?></td>
                        <td><strong><?= e((string) $fila['PTS']) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require '../../includes/app_footer.php'; ?>
