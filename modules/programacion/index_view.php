<?php

include '../../config/database.php';

$pageTitle = 'Programacion';
$pageHeading = 'Programacion y notificaciones';
$pageDescription = 'Revisa partidos programados y genera mensajes rapidos de WhatsApp para capitanes con numero registrado.';
$activeMenu = 'programacion';

$partidos = $conexion->query('
    SELECT
        p.id_partido,
        p.fecha,
        p.lugar,
        p.estado,
        local.nombre AS local,
        visitante.nombre AS visitante,
        local.capitan AS capitan_local,
        local.telefono_capitan AS telefono_local,
        visitante.capitan AS capitan_visitante,
        visitante.telefono_capitan AS telefono_visitante
    FROM partidos p
    INNER JOIN equipos local ON p.equipo_local = local.id_equipo
    INNER JOIN equipos visitante ON p.equipo_visitante = visitante.id_equipo
    ORDER BY p.fecha ASC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Partidos por notificar</h2>
            <p>El enlace abre WhatsApp Web. Solo funciona si el equipo tiene capitan y telefono registrados.</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="<?= e(app_url('modules/equipos/index.php')) ?>">
                <i class="fa-solid fa-shield-halved"></i>
                Revisar equipos
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Partido</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Contacto local</th>
                    <th>Contacto visitante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partidos as $partido): ?>
                    <?php
                    $mensajeLocal = rawurlencode(
                        'Hola ' . ($partido['capitan_local'] ?: 'capitan') .
                        ', el equipo ' . $partido['local'] .
                        ' tiene un partido programado contra ' . $partido['visitante'] .
                        ' el ' . $partido['fecha'] . ' en ' . $partido['lugar'] . '.'
                    );
                    $mensajeVisitante = rawurlencode(
                        'Hola ' . ($partido['capitan_visitante'] ?: 'capitan') .
                        ', el equipo ' . $partido['visitante'] .
                        ' tiene un partido programado contra ' . $partido['local'] .
                        ' el ' . $partido['fecha'] . ' en ' . $partido['lugar'] . '.'
                    );

                    $waLocal = !empty($partido['telefono_local'])
                        ? app_url('modules/notificaciones/enviar.php') . '?id_partido=' . urlencode((string) $partido['id_partido']) . '&destino=local'
                        : null;

                    $waVisitante = !empty($partido['telefono_visitante'])
                        ? app_url('modules/notificaciones/enviar.php') . '?id_partido=' . urlencode((string) $partido['id_partido']) . '&destino=visitante'
                        : null;
                    ?>
                    <tr>
                        <td><?= e($partido['local']) ?> vs <?= e($partido['visitante']) ?></td>
                        <td><?= e((string) $partido['fecha']) ?></td>
                        <td><?= e((string) $partido['lugar']) ?></td>
                        <td><?= e((string) $partido['estado']) ?></td>
                        <td><?= e((string) ($partido['capitan_local'] ?: 'Sin registro')) ?></td>
                        <td><?= e((string) ($partido['capitan_visitante'] ?: 'Sin registro')) ?></td>
                        <td>
                            <div class="table-stack">
                                <?php if ($waLocal): ?>
                                    <a class="btn btn-success" target="_blank" rel="noopener noreferrer" href="<?= e($waLocal) ?>">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Local
                                    </a>
                                <?php else: ?>
                                    <span class="badge badge--warning">Local sin telefono</span>
                                <?php endif; ?>

                                <?php if ($waVisitante): ?>
                                    <a class="btn btn-success" target="_blank" rel="noopener noreferrer" href="<?= e($waVisitante) ?>">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Visitante
                                    </a>
                                <?php else: ?>
                                    <span class="badge badge--warning">Visitante sin telefono</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require '../../includes/app_footer.php'; ?>
