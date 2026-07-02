<?php

include '../../config/database.php';

$pageTitle = 'Usuarios';
$pageHeading = 'Gestion de usuarios';
$pageDescription = 'Administra accesos, roles y datos basicos de las cuentas del sistema.';
$activeMenu = 'usuarios';

$usuarios = $conexion->query('
    SELECT u.*, r.nombre AS rol
    FROM usuarios u
    INNER JOIN roles r ON u.id_rol = r.id_rol
    ORDER BY u.id_usuario DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Usuarios registrados</h2>
            <p>Control de acceso para administradores e instituciones participantes.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo usuario
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= e((string) $usuario['id_usuario']) ?></td>
                        <td><?= e(trim($usuario['nombre'] . ' ' . $usuario['apellido'])) ?></td>
                        <td><?= e($usuario['email']) ?></td>
                        <td><?= e((string) ($usuario['telefono'] ?? '-')) ?></td>
                        <td><?= e($usuario['rol']) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $usuario['id_usuario']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
                                    <input type="hidden" name="id" value="<?= e((string) $usuario['id_usuario']) ?>">
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
