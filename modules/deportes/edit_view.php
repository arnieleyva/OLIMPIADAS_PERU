<?php

include '../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM deportes WHERE id_deporte = ?');
$stmt->execute([$id]);
$deporte = $stmt->fetch();

if (!$deporte) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Editar deporte';
$pageHeading = 'Actualizar deporte';
$pageDescription = 'Ajusta el nombre o tipo de la disciplina seleccionada.';
$activeMenu = 'deportes';

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2><?= e($deporte['nombre']) ?></h2>
            <p>Actualiza la configuracion de esta disciplina.</p>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $deporte['id_deporte']) ?>">

        <div class="field">
            <label for="nombre">Nombre del deporte</label>
            <input id="nombre" type="text" name="nombre" value="<?= e($deporte['nombre']) ?>" required>
        </div>

        <div class="field">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" required>
                <?php foreach (['Varones', 'Damas', 'Mixto'] as $tipo): ?>
                    <option value="<?= e($tipo) ?>" <?= $deporte['tipo'] === $tipo ? 'selected' : '' ?>><?= e($tipo) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar deporte
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
