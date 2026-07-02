<?php

include '../../config/database.php';

$pageTitle = 'Deportes';
$pageHeading = 'Gestion de deportes';
$pageDescription = 'Administra las disciplinas habilitadas para la competencia.';
$activeMenu = 'deportes';

$deportes = $conexion->query('SELECT * FROM deportes ORDER BY id_deporte DESC')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Disciplinas registradas</h2>
            <p>Organiza las categorias deportivas disponibles para programacion y resultados.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo deporte
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deportes as $deporte): ?>
                    <tr>
                        <td><?= e((string) $deporte['id_deporte']) ?></td>
                        <td><?= e($deporte['nombre']) ?></td>
                        <td><?= e($deporte['tipo']) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $deporte['id_deporte']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este deporte?');">
                                    <input type="hidden" name="id" value="<?= e((string) $deporte['id_deporte']) ?>">
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
