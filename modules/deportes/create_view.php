<?php

$pageTitle = 'Nuevo deporte';
$pageHeading = 'Registrar deporte';
$pageDescription = 'Define la disciplina y el tipo de competencia que se utilizara en el torneo.';
$activeMenu = 'deportes';

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Datos del deporte</h2>
            <p>Este registro se usara en equipos, partidos y resultados.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="field">
            <label for="nombre">Nombre del deporte</label>
            <input id="nombre" type="text" name="nombre" required>
        </div>

        <div class="field">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" required>
                <option value="Varones">Varones</option>
                <option value="Damas">Damas</option>
                <option value="Mixto">Mixto</option>
            </select>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar deporte
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
