<?php

include '../../config/database.php';

$pageTitle = 'Nuevo jugador';
$pageHeading = 'Registrar jugador';
$pageDescription = 'Agrega un participante al equipo correspondiente con sus datos basicos.';
$activeMenu = 'jugadores';

$equipos = $conexion->query('SELECT * FROM equipos ORDER BY nombre')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2>Ficha del jugador</h2>
            <p>Registra informacion deportiva y de identificacion del participante.</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" class="form-grid">
        <div class="field">
            <label for="id_equipo">Equipo</label>
            <select id="id_equipo" name="id_equipo" required>
                <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= e((string) $equipo['id_equipo']) ?>"><?= e($equipo['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombres">Nombres</label>
                <input id="nombres" type="text" name="nombres" required>
            </div>
            <div class="field">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" required>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="numero_camiseta">Numero de camiseta</label>
                <input id="numero_camiseta" type="number" name="numero_camiseta" min="0">
            </div>
            <div class="field">
                <label for="posicion">Posicion</label>
                <input id="posicion" type="text" name="posicion">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="dni">DNI</label>
                <input id="dni" type="text" name="dni" maxlength="8">
            </div>
            <div class="field">
                <label for="edad">Edad</label>
                <input id="edad" type="number" name="edad" min="1">
            </div>
        </div>

        <div class="field">
            <label for="genero">Genero</label>
            <select id="genero" name="genero">
                <option value="">Selecciona</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Cancelar
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Guardar jugador
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
