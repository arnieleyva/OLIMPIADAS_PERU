<?php
include '../../config/database.php';
$pageTitle = 'Llaves';
$pageHeading = 'Llaves y fase final';
$pageDescription = 'Vista tipo bracket para mostrar cruces proyectados de semifinal y final.';
$activeMenu = 'resultados';
$top = $conexion->query('SELECT * FROM vw_tabla_posiciones ORDER BY PTS DESC, DG DESC, GF DESC, nombre ASC LIMIT 4')->fetchAll();
require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title"><h2>Proyeccion de llaves</h2><p>Se arma con los cuatro mejores equipos de la tabla actual.</p></div>
    </div>
    <?php if (count($top) < 4): ?>
        <div class="empty-state">Se necesitan al menos 4 equipos con resultados para generar una fase final visual.</div>
    <?php else: ?>
        <div class="bracket-board">
            <div class="bracket-column">
                <div class="bracket-column__title">Semifinal 1</div>
                <article class="bracket-match">
                    <h3>Cruce A</h3>
                    <div class="bracket-team"><span>Puesto 1</span><strong><?= e($top[0]['nombre']) ?></strong></div>
                    <div class="bracket-team"><span>Puesto 4</span><strong><?= e($top[3]['nombre']) ?></strong></div>
                </article>
                <div class="bracket-column__title">Semifinal 2</div>
                <article class="bracket-match">
                    <h3>Cruce B</h3>
                    <div class="bracket-team"><span>Puesto 2</span><strong><?= e($top[1]['nombre']) ?></strong></div>
                    <div class="bracket-team"><span>Puesto 3</span><strong><?= e($top[2]['nombre']) ?></strong></div>
                </article>
            </div>
            <div class="bracket-column">
                <div class="bracket-column__title">Final</div>
                <article class="bracket-match">
                    <h3>Gran final</h3>
                    <div class="bracket-team"><span>Ganador A</span><strong>Por definir</strong></div>
                    <div class="bracket-team"><span>Ganador B</span><strong>Por definir</strong></div>
                </article>
                <article class="bracket-match">
                    <h3>Nota</h3>
                    <p class="muted">Esta vista ayuda a exponer una fase eliminatoria visual similar a plataformas de torneos.</p>
                </article>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php require '../../includes/app_footer.php'; ?>
