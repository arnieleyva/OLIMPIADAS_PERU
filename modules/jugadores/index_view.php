<?php

include '../../config/database.php';

$pageTitle = 'Jugadores';
$pageHeading = 'Gestion de jugadores';
$pageDescription = 'Administra nomina, equipo, camiseta y datos individuales de cada participante.';
$activeMenu = 'jugadores';

$jugadores = $conexion->query('
    SELECT jugadores.*, equipos.nombre AS equipo
    FROM jugadores
    INNER JOIN equipos ON jugadores.id_equipo = equipos.id_equipo
    ORDER BY jugadores.id_jugador DESC
')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="panel-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Plantel registrado</h2>
            <p>Consulta rapidamente dorsal, posicion y equipo de cada jugador.</p>
        </div>
        <div class="actions">
            <a class="btn btn-success" href="crear.php">
                <i class="fa-solid fa-plus"></i>
                Nuevo jugador
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jugador</th>
                    <th>Equipo</th>
                    <th>Camiseta</th>
                    <th>Posicion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $jugador): ?>
                    <tr>
                        <td><?= e((string) $jugador['id_jugador']) ?></td>
                        <td><?= e($jugador['nombres'] . ' ' . $jugador['apellidos']) ?></td>
                        <td><?= e($jugador['equipo']) ?></td>
                        <td><?= e((string) ($jugador['numero_camiseta'] ?? '-')) ?></td>
                        <td><?= e((string) ($jugador['posicion'] ?? '-')) ?></td>
                        <td>
                            <div class="table-stack">
                                <a class="btn btn-warning" href="editar.php?id=<?= e((string) $jugador['id_jugador']) ?>">
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>
                                <form class="inline-form" action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar este jugador?');">
                                    <input type="hidden" name="id" value="<?= e((string) $jugador['id_jugador']) ?>">
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
