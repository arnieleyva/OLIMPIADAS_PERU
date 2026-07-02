<?php
$pageTitle = 'Nuevo evento';
$pageHeading = 'Registrar evento';
$pageDescription = 'Crea una edicion del campeonato con nombre, descripcion y rango de fechas.';
$activeMenu = 'eventos';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2>Datos del evento</h2><p>Sirve para separar torneos o ediciones futuras.</p></div></div>
    <form action="guardar.php" method="POST" class="form-grid">
        <div class="field"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" required></div>
        <div class="field"><label for="descripcion">Descripcion</label><textarea id="descripcion" name="descripcion"></textarea></div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="fecha_inicio">Fecha de inicio</label><input id="fecha_inicio" type="date" name="fecha_inicio"></div>
            <div class="field"><label for="fecha_fin">Fecha de fin</label><input id="fecha_fin" type="date" name="fecha_fin"></div>
        </div>
        <div class="field"><label for="estado">Estado</label><select id="estado" name="estado"><option value="Pendiente">Pendiente</option><option value="En Curso">En Curso</option><option value="Finalizado">Finalizado</option></select></div>
        <div class="action-row"><a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Cancelar</a><button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar evento</button></div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
