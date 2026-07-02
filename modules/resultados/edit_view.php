<?php
include '../../config/database.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM resultados WHERE id_resultado = ?');
$stmt->execute([$id]);
$resultado = $stmt->fetch();
if (!$resultado) { header('Location: index.php'); exit(); }
$pageTitle = 'Editar resultado';
$pageHeading = 'Actualizar resultado';
$pageDescription = 'Corrige el marcador final y observaciones del partido registrado.';
$activeMenu = 'resultados';
require '../../includes/app_header.php';
?>
<section class="form-card">
    <div class="toolbar"><div class="toolbar__title"><h2>Resultado #<?= e((string) $resultado['id_resultado']) ?></h2><p>Actualiza datos del marcador y observaciones.</p></div></div>
    <form action="actualizar.php" method="POST" class="form-grid">
        <input type="hidden" name="id_resultado" value="<?= e((string) $resultado['id_resultado']) ?>">
        <div class="form-grid form-grid--two">
            <div class="field"><label for="marcador_local">Marcador local</label><input id="marcador_local" type="number" name="marcador_local" min="0" value="<?= e((string) $resultado['marcador_local']) ?>" required></div>
            <div class="field"><label for="marcador_visitante">Marcador visitante</label><input id="marcador_visitante" type="number" name="marcador_visitante" min="0" value="<?= e((string) $resultado['marcador_visitante']) ?>" required></div>
        </div>
        <div class="field"><label for="observaciones">Observaciones</label><textarea id="observaciones" name="observaciones"><?= e((string) ($resultado['observaciones'] ?? '')) ?></textarea></div>
        <div class="action-row"><a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-arrow-left"></i> Volver</a><button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Actualizar resultado</button></div>
    </form>
</section>
<?php require '../../includes/app_footer.php'; ?>
