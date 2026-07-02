<?php
include '../../config/database.php';
$pageTitle = 'Eventos';
$pageHeading = 'Gestion de eventos';
$pageDescription = 'Define torneos, temporadas o ediciones del campeonato con sus fechas y estado.';
$activeMenu = 'eventos';
$eventos = $conexion->query('SELECT * FROM eventos ORDER BY fecha_inicio DESC, id_evento DESC')->fetchAll();
require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title"><h2>Eventos del sistema</h2><p>Los partidos quedan asociados a un evento para mantener orden y trazabilidad.</p></div>
        <div class="actions"><a class="btn btn-success" href="crear.php"><i class="fa-solid fa-plus"></i> Nuevo evento</a></div>
    </div>
    <div class="table-responsive">
        <table class="app-table">
            <thead><tr><th>ID</th><th>Nombre</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= e((string) $evento['id_evento']) ?></td>
                        <td><?= e($evento['nombre']) ?></td>
                        <td><?= e((string) ($evento['fecha_inicio'] ?? '-')) ?></td>
                        <td><?= e((string) ($evento['fecha_fin'] ?? '-')) ?></td>
                        <td><?= e((string) ($evento['estado'] ?: 'Pendiente')) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $evento['id_evento']) ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este evento?');">
                                    <input type="hidden" name="id" value="<?= e((string) $evento['id_evento']) ?>">
                                    <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i> Eliminar</button>
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
