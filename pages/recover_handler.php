<?php

require_once dirname(__DIR__) . '/includes/auth.php';
include dirname(__DIR__) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . app_url('recuperar.php'));
    exit();
}

$email = trim((string) ($_POST['email'] ?? ''));
$resetUrl = null;

if ($email !== '') {
    $stmt = $conexion->prepare('SELECT id_usuario, nombre, apellido FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');

        $conexion->prepare('DELETE FROM recuperacion_password WHERE id_usuario = ?')->execute([$usuario['id_usuario']]);

        $stmt = $conexion->prepare('
            INSERT INTO recuperacion_password (
                id_usuario,
                token,
                fecha_expiracion,
                usado
            ) VALUES (?, ?, ?, 0)
        ');

        $stmt->execute([
            $usuario['id_usuario'],
            $token,
            $expiresAt,
        ]);

        $resetUrl = app_url('restablecer.php') . '?token=' . urlencode($token);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enlace generado | Olimpiadas Peru</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?= e(asset_url('css/style.css')) ?>">
</head>
<body>
<div class="auth-page">
    <section class="auth-card auth-card--wide">
        <div class="auth-brand">
            <div class="auth-brand__logo">
                <i class="fa-solid fa-link"></i>
            </div>
            <div>
                <strong>Solicitud procesada</strong>
                <div class="muted">Recuperacion de acceso</div>
            </div>
        </div>

        <h1>Enlace temporal generado</h1>
        <p>Si el correo existe en el sistema, se ha preparado una solicitud de recuperacion valida por una hora.</p>

        <div class="notice notice--warning">
            Esta version local no tiene SMTP configurado, por eso el enlace se muestra en pantalla para pruebas y demostracion.
        </div>

        <?php if ($resetUrl !== null): ?>
            <div class="field">
                <label>Enlace de restablecimiento</label>
                <input type="text" value="<?= e('http://localhost' . $resetUrl) ?>" readonly>
            </div>

            <a class="btn btn-primary" href="<?= e($resetUrl) ?>">
                <i class="fa-solid fa-unlock-keyhole"></i>
                Abrir formulario de restablecimiento
            </a>
        <?php else: ?>
            <div class="notice notice--success">
                La solicitud se registro correctamente. Si el correo pertenece a una cuenta, podras continuar con la recuperacion desde el enlace generado por el sistema.
            </div>
        <?php endif; ?>

        <div class="auth-links">
            <a href="<?= e(app_url('index.php')) ?>">Volver al inicio de sesion</a>
        </div>
    </section>
</div>
</body>
</html>
