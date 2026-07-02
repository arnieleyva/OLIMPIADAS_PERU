<?php
include '../../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM eventos WHERE id_evento = ?');
$stmt->execute([$id]);
$evento = $stmt->fetch();
if (!$evento) { header('Location: index.php'); exit(); }
$pageTitle = 'Editar evento';
$pageHeading = 'Actualizar evento';
$pageDescription = 'Modifica fechas, nombre o estado del evento seleccionado.';
$activeMenu = 'eventos';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2><?= e($evento['nombre']) ?></h2><p>Ajusta la configuracion general del evento.</p></div></div>
    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $evento['id_evento']) ?>">
        <div class="field"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" value="<?= e($evento['nombre']) ?>" required></div>
        <div class="field"><label for="descripcion">Descripcion</label><textarea id="descripcion" name="descripcion"><?= e((string) ($evento['descripcion'] ?? '')) ?></textarea></div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="fecha_inicio">Fecha de inicio</label><input id="fecha_inicio" type="date" name="fecha_inicio" value="<?= e((string) ($evento['fecha_inicio'] ?? '')) ?>"></div>
            <div class="field"><label for="fecha_fin">Fecha de fin</label><input id="fecha_fin" type="date" name="fecha_fin" value="<?= e((string) ($evento['fecha_fin'] ?? '')) ?>"></div>
        </div>
        <div class="field"><label for="estado">Estado</label><select id="estado" name="estado"><?php foreach (['Pendiente','En Curso','Finalizado'] as $estado): ?><option value="<?= e($estado) ?>" <?= (($evento['estado'] ?: 'Pendiente') === $estado) ? 'selected' : '' ?>><?= e($estado) ?></option><?php endforeach; ?></select></div>
        <div class="action-row"><a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Volver</a><button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Actualizar evento</button></div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
