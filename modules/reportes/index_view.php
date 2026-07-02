<?php
$pageTitle = 'Reportes';
$pageHeading = 'Exportacion de reportes';
$pageDescription = 'Descarga reportes CSV para sustentacion, control o revision administrativa.';
$activeMenu = 'reportes';
require '../../includes/app_header.php';
$reportes = [
    ['tipo' => 'instituciones', 'titulo' => 'Instituciones'],
    ['tipo' => 'eventos', 'titulo' => 'Eventos'],
    ['tipo' => 'arbitros', 'titulo' => 'Arbitros'],
    ['tipo' => 'equipos', 'titulo' => 'Equipos'],
    ['tipo' => 'jugadores', 'titulo' => 'Jugadores'],
    ['tipo' => 'partidos', 'titulo' => 'Partidos'],
    ['tipo' => 'resultados', 'titulo' => 'Resultados'],
    ['tipo' => 'notificaciones', 'titulo' => 'Notificaciones'],
];
?>
<section class="feature-grid">
    <?php foreach ($reportes as $reporte): ?>
        <article class="mini-card">
            <h3><?= e($reporte['titulo']) ?></h3>
            <p>Exporta un archivo CSV de <?= strtolower(e($reporte['titulo'])) ?> para evidencia o análisis externo.</p>
            <div class="actions">
                <a class="btn btn-primary" href="exportar.php?tipo=<?= e($reporte['tipo']) ?>">
                    <i class="fa-solid fa-download"></i>
                    Descargar CSV
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php require '../../includes/app_footer.php'; ?>
