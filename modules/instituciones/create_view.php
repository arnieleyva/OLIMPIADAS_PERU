<?php
$pageTitle = 'Nueva institucion';
$pageHeading = 'Registrar institucion';
$pageDescription = 'Crea la ficha institucional base para vincular delegaciones y responsables.';
$activeMenu = 'instituciones';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2>Datos institucionales</h2><p>Completa la informacion de contacto y representacion.</p></div></div>
    <form action="guardar.php" method="POST" class="form-grid">
        <div class="field"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" required></div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="ruc">RUC</label><input id="ruc" type="text" name="ruc" maxlength="11"></div>
            <div class="field"><label for="representante">Representante</label><input id="representante" type="text" name="representante"></div>
        </div>
        <div class="form-grid form-grid--two">
            <div class="field"><label for="telefono">Telefono</label><input id="telefono" type="text" name="telefono"></div>
            <div class="field"><label for="email">Correo</label><input id="email" type="email" name="email"></div>
        </div>
        <div class="field"><label for="direccion">Direccion</label><textarea id="direccion" name="direccion"></textarea></div>
        <div class="action-row">
            <a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar institucion</button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
