<?php
include '../../config/database.php';
$pageTitle = 'Notificaciones';
$pageHeading = 'Historial de notificaciones';
$pageDescription = 'Revisa mensajes generados desde el sistema para coordinación del torneo.';
$activeMenu = 'notificaciones';
$notificaciones = $conexion->query('SELECT * FROM notificaciones ORDER BY id_notificacion DESC LIMIT 100')->fetchAll();
require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title"><h2>Bitacora de mensajes</h2><p>Incluye avisos de programación, resultados o mensajes emitidos desde la plataforma.</p></div>
    </div>
    <div class="table-responsive">
        <table class="app-table">
            <thead><tr><th>ID</th><th>Titulo</th><th>Mensaje</th><th>Fecha</th></tr></thead>
            <tbody>
                <?php if ($notificaciones === []): ?>
                    <tr><td colspan="4" class="empty-state">Todavia no hay notificaciones registradas.</td></tr>
                <?php else: ?>
                    <?php foreach ($notificaciones as $notificacion): ?>
                        <tr>
                            <td><?= e((string) $notificacion['id_notificacion']) ?></td>
                            <td><?= e((string) ($notificacion['titulo'] ?? '-')) ?></td>
                            <td><?= e((string) ($notificacion['mensaje'] ?? '-')) ?></td>
                            <td><?= e((string) $notificacion['fecha']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require '../../includes/app_footer.php'; ?>
