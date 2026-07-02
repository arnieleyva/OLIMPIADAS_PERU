<?php

include '../../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM jugadores WHERE id_jugador = ?');
$stmt->execute([$id]);
$jugador = $stmt->fetch();

if (!$jugador) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Editar jugador';
$pageHeading = 'Actualizar jugador';
$pageDescription = 'Ajusta equipo, datos personales y posicion del jugador seleccionado.';
$activeMenu = 'jugadores';

$equipos = $conexion->query('SELECT * FROM equipos ORDER BY nombre')->fetchAll();

require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar">
        <div class="toolbar__title">
            <h2><?= e($jugador['nombres'] . ' ' . $jugador['apellidos']) ?></h2>
            <p>Actualiza la ficha deportiva del jugador.</p>
        </div>
    </div>

    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id" value="<?= e((string) $jugador['id_jugador']) ?>">

        <div class="field">
            <label for="id_equipo">Equipo</label>
            <select id="id_equipo" name="id_equipo" required>
                <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= e((string) $equipo['id_equipo']) ?>" <?= (int) $jugador['id_equipo'] === (int) $equipo['id_equipo'] ? 'selected' : '' ?>>
                        <?= e($equipo['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="nombres">Nombres</label>
                <input id="nombres" type="text" name="nombres" value="<?= e($jugador['nombres']) ?>" required>
            </div>
            <div class="field">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" value="<?= e($jugador['apellidos']) ?>" required>
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="dni">DNI</label>
                <input id="dni" type="text" name="dni" maxlength="8" value="<?= e((string) ($jugador['dni'] ?? '')) ?>">
            </div>
            <div class="field">
                <label for="edad">Edad</label>
                <input id="edad" type="number" name="edad" min="1" value="<?= e((string) ($jugador['edad'] ?? '')) ?>">
            </div>
        </div>

        <div class="form-grid form-grid--two">
            <div class="field">
                <label for="genero">Genero</label>
                <select id="genero" name="genero">
                    <option value="">Selecciona</option>
                    <option value="M" <?= $jugador['genero'] === 'M' ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= $jugador['genero'] === 'F' ? 'selected' : '' ?>>Femenino</option>
                </select>
            </div>
            <div class="field">
                <label for="numero_camiseta">Numero de camiseta</label>
                <input id="numero_camiseta" type="number" name="numero_camiseta" min="0" value="<?= e((string) ($jugador['numero_camiseta'] ?? '')) ?>">
            </div>
        </div>

        <div class="field">
            <label for="posicion">Posicion</label>
            <input id="posicion" type="text" name="posicion" value="<?= e((string) ($jugador['posicion'] ?? '')) ?>">
        </div>

        <div class="action-row">
            <a class="btn btn-secondary" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                Actualizar jugador
            </button>
        </div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
