<?php

include '../../config/database.php';

$pageTitle = 'Instituciones';
$pageHeading = 'Gestion de instituciones';
$pageDescription = 'Administra colegios, academias o entidades responsables de cada delegacion deportiva.';
$activeMenu = 'instituciones';

$instituciones = $conexion->query('SELECT * FROM instituciones ORDER BY id_institucion DESC')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Instituciones registradas</h2>
            <p>Estas entidades se vinculan directamente con equipos, responsables y reportes.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php"><i class="fa-solid fa-plus"></i> Nueva institucion</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Representante</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instituciones as $institucion): ?>
                    <tr>
                        <td><?= e((string) $institucion['id_institucion']) ?></td>
                        <td><?= e($institucion['nombre']) ?></td>
                        <td><?= e((string) ($institucion['representante'] ?? '-')) ?></td>
                        <td><?= e((string) ($institucion['telefono'] ?? '-')) ?></td>
                        <td><?= e((string) ($institucion['email'] ?? '-')) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $institucion['id_institucion']) ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar esta institucion?');">
                                    <input type="hidden" name="id" value="<?= e((string) $institucion['id_institucion']) ?>">
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
