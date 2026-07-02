<?php
include '../../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM instituciones WHERE id_institucion = ?');
$stmt->execute([$id]);
$institucion = $stmt->fetch();
if (!$institucion) { header('Location: index.php'); exit(); }
$pageTitle = 'Editar institucion';
$pageHeading = 'Actualizar institucion';
$pageDescription = 'Edita informacion institucional y de contacto.';
$activeMenu = 'instituciones';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2><?= e($institucion['nombre']) ?></h2><p>Actualiza la informacion de la entidad seleccionada.</p></div></div>
    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $institucion['id_institucion']) ?>">
        <div class="field"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" value="<?= e($institucion['nombre']) ?>" required></div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="ruc">RUC</label><input id="ruc" type="text" name="ruc" maxlength="11" value="<?= e((string) ($institucion['ruc'] ?? '')) ?>"></div>
            <div class="field"><label for="representante">Representante</label><input id="representante" type="text" name="representante" value="<?= e((string) ($institucion['representante'] ?? '')) ?>"></div>
        </div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="telefono">Telefono</label><input id="telefono" type="text" name="telefono" value="<?= e((string) ($institucion['telefono'] ?? '')) ?>"></div>
            <div class="field"><label for="email">Correo</label><input id="email" type="email" name="email" value="<?= e((string) ($institucion['email'] ?? '')) ?>"></div>
        </div>
        <div class="field"><label for="direccion">Direccion</label><textarea id="direccion" name="direccion"><?= e((string) ($institucion['direccion'] ?? '')) ?></textarea></div>
        <div class="action-row">
            <a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Volver</a>
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Actualizar institucion</button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
