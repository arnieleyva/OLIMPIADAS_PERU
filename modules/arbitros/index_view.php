<?php
include '../../config/database.php';
$pageTitle = 'Arbitros';
$pageHeading = 'Gestion de arbitros';
$pageDescription = 'Administra jueces, contacto y experiencia para asignarlos a los partidos.';
$activeMenu = 'arbitros';
$arbitros = $conexion->query('SELECT * FROM arbitros ORDER BY id_arbitro DESC')->fetchAll();
require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title"><h2>Plantilla arbitral</h2><p>Relacion de arbitros disponibles para el campeonato.</p></div>
        <div class="actions"><a class="btn btn-success" href="crear.php"><i class="fa-solid fa-plus"></i> Nuevo arbitro</a></div>
    </div>
    <div class="table-responsive">
        <table class="app-table">
            <thead><tr><th>ID</th><th>Nombre completo</th><th>Telefono</th><th>Experiencia</th><th>Acciones</th></tr></thead>
            <tbody>
                <?php foreach ($arbitros as $arbitro): ?>
                    <tr>
                        <td><?= e((string) $arbitro['id_arbitro']) ?></td>
                        <td><?= e(trim((string) ($arbitro['nombres'] ?? '') . ' ' . (string) ($arbitro['apellidos'] ?? ''))) ?></td>
                        <td><?= e((string) ($arbitro['telefono'] ?? '-')) ?></td>
                        <td><?= e((string) ($arbitro['experiencia'] ?? '-')) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $arbitro['id_arbitro']) ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este arbitro?');">
                                    <input type="hidden" name="id" value="<?= e((string) $arbitro['id_arbitro']) ?>">
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
