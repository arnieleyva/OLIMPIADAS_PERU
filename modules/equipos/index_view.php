<?php

include '../../config/database.php';

$pageTitle = 'Equipos';
$pageHeading = 'Gestion de equipos';
$pageDescription = 'Controla delegaciones, capitanes, categoria y disciplina asociada a cada equipo.';
$activeMenu = 'equipos';

$equipos = $conexion->query('
    SELECT
        equipos.*,
        instituciones.nombre AS institucion,
        deportes.nombre AS deporte,
        categorias.nombre AS categoria
    FROM equipos
    INNER JOIN instituciones ON equipos.id_institucion = instituciones.id_institucion
    INNER JOIN deportes ON equipos.id_deporte = deportes.id_deporte
    INNER JOIN categorias ON equipos.id_categoria = categorias.id_categoria
    ORDER BY equipos.id_equipo DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Delegaciones registradas</h2>
            <p>Visualiza responsables, categoria e informacion deportiva clave.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo equipo
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Institucion</th>
                    <th>Deporte</th>
                    <th>Categoria</th>
                    <th>Capitan</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipos as $equipo): ?>
                    <tr>
                        <td><?= e((string) $equipo['id_equipo']) ?></td>
                        <td><?= e($equipo['nombre']) ?></td>
                        <td><?= e($equipo['institucion']) ?></td>
                        <td><?= e($equipo['deporte']) ?></td>
                        <td><?= e($equipo['categoria']) ?></td>
                        <td><?= e((string) ($equipo['capitan'] ?? '-')) ?></td>
                        <td><?= e((string) ($equipo['telefono_capitan'] ?? '-')) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $equipo['id_equipo']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este equipo?');">
                                    <input type="hidden" name="id" value="<?= e((string) $equipo['id_equipo']) ?>">
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
