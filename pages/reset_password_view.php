<?php

require_once dirname(__DIR__) . '/includes/auth.php';
include dirname(__DIR__) . '/config/database.php';

$token = trim((string) ($_POST['token'] ?? $_GET['token'] ?? ''));
$errorMessage = '';
$success = false;
$recovery = null;

$stmt = $conexion->prepare('
    SELECT rp.id_recuperacion, rp.id_usuario, rp.fecha_expiracion, rp.usado, u.nombre, u.apellido
    FROM recuperacion_password rp
    INNER JOIN usuarios u ON u.id_usuario = rp.id_usuario
    WHERE rp.token = ?
    LIMIT 1
');

$stmt->execute([$token]);
$recovery = $stmt->fetch();

if (!$recovery) {
    $errorMessage = 'El enlace no es valido o ya no existe.';
} else {
    $expired = !empty($recovery['fecha_expiracion']) && strtotime((string) $recovery['fecha_expiracion']) < time();

    if ((int) $recovery['usado'] === 1 || $expired) {
        $errorMessage = 'El enlace ya fue utilizado o ha expirado.';
    }
}

if ($errorMessage === '' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = (string) ($_POST['password'] ?? '');
    $passwordConfirm = (string) ($_POST['password_confirm'] ?? '');

    if ($password === '' || $passwordConfirm === '') {
        $errorMessage = 'Completa ambos campos de contrasena.';
    } elseif ($password !== $passwordConfirm) {
        $errorMessage = 'Las contrasenas no coinciden.';
    } else {
        $conexion->prepare('UPDATE usuarios SET password_hash = ? WHERE id_usuario = ?')->execute([
            password_hash($password, PASSWORD_DEFAULT),
            $recovery['id_usuario'],
        ]);

        $conexion->prepare('UPDATE recuperacion_password SET usado = 1 WHERE id_recuperacion = ?')->execute([
            $recovery['id_recuperacion'],
        ]);

        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar contrasena | Olimpiadas Peru</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?= e(asset_url('css/style.css')) ?>">
</head>
<body>
<div class="auth-page">
    <section class="auth-card">
        <div class="auth-brand">
            <div class="auth-brand__logo">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div>
                <strong>Actualizacion de acceso</strong>
                <div class="muted">Credenciales del sistema</div>
            </div>
        </div>

        <h1>Nueva contrasena</h1>
        <p>Usa una contrasena segura para continuar administrando tu institucion y el campeonato.</p>

        <?php if ($success): ?>
            <div class="notice notice--success">La contrasena se actualizo correctamente.</div>
            <div class="auth-links">
                <a href="<?= e(app_url('index.php')) ?>?reset=1">Ir al inicio de sesion</a>
            </div>
        <?php else: ?>
            <?php if ($errorMessage !== ''): ?>
                <div class="notice notice--error"><?= e($errorMessage) ?></div>
            <?php endif; ?>

            <?php if ($errorMessage === '' && $recovery): ?>
                <div class="notice notice--warning">
                    Cuenta: <?= e(trim($recovery['nombre'] . ' ' . $recovery['apellido'])) ?>
                </div>
            <?php endif; ?>

            <?php if ($errorMessage === ''): ?>
                <form class="auth-form" method="POST">
                    <input type="hidden" name="token" value="<?= e($token) ?>">

                    <div class="field">
                        <label for="password">Nueva contrasena</label>
                        <input id="password" type="password" name="password" required>
                    </div>

                    <div class="field">
                        <label for="password_confirm">Confirmar contrasena</label>
                        <input id="password_confirm" type="password" name="password_confirm" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar contrasena
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</div>
</body>
</html>
