<?php
$pageTitle = 'Nuevo arbitro';
$pageHeading = 'Registrar arbitro';
$pageDescription = 'Agrega un arbitro disponible para asignaciones de partidos.';
$activeMenu = 'arbitros';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2>Datos del arbitro</h2><p>Completa nombre, contacto y nivel de experiencia.</p></div></div>
    <form action="guardar.php" method="POST" class="form-grid">
        <div class="form-grid form-grid--two">
            <div class="field"><label for="nombres">Nombres</label><input id="nombres" type="text" name="nombres" required></div>
            <div class="field"><label for="apellidos">Apellidos</label><input id="apellidos" type="text" name="apellidos" required></div>
        </div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="telefono">Telefono</label><input id="telefono" type="text" name="telefono"></div>
            <div class="field"><label for="experiencia">Experiencia</label><input id="experiencia" type="text" name="experiencia" placeholder="Ej. 5 años / liga escolar"></div>
        </div>
        <div class="action-row"><a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Cancelar</a><button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar arbitro</button></div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
