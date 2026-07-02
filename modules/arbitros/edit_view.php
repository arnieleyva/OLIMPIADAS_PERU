<?php
include '../../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM arbitros WHERE id_arbitro = ?');
$stmt->execute([$id]);
$arbitro = $stmt->fetch();
if (!$arbitro) { header('Location: index.php'); exit(); }
$pageTitle = 'Editar arbitro';
$pageHeading = 'Actualizar arbitro';
$pageDescription = 'Edita la ficha del arbitro seleccionado.';
$activeMenu = 'arbitros';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2><?= e(trim((string) ($arbitro['nombres'] ?? '') . ' ' . (string) ($arbitro['apellidos'] ?? ''))) ?></h2><p>Actualiza la informacion arbitral y de contacto.</p></div></div>
    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $arbitro['id_arbitro']) ?>">
        <div class="form-grid form-grid--two">
            <div class="field"><label for="nombres">Nombres</label><input id="nombres" type="text" name="nombres" value="<?= e((string) ($arbitro['nombres'] ?? '')) ?>" required></div>
            <div class="field"><label for="apellidos">Apellidos</label><input id="apellidos" type="text" name="apellidos" value="<?= e((string) ($arbitro['apellidos'] ?? '')) ?>" required></div>
        </div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="telefono">Telefono</label><input id="telefono" type="text" name="telefono" value="<?= e((string) ($arbitro['telefono'] ?? '')) ?>"></div>
            <div class="field"><label for="experiencia">Experiencia</label><input id="experiencia" type="text" name="experiencia" value="<?= e((string) ($arbitro['experiencia'] ?? '')) ?>"></div>
        </div>
        <div class="action-row"><a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Volver</a><button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Actualizar arbitro</button></div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
