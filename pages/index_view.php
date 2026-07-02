<?php

require_once dirname(__DIR__) . '/includes/auth.php';

if (isset($_SESSION['usuario'])) {
    header('Location: ' . app_url('panel.php'));
    exit();
}

$errorMessage = trim((string) ($_GET['error'] ?? ''));
$registered = isset($_GET['registered']);
$passwordReset = isset($_GET['reset']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ingreso | Olimpiadas Peru</title>
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
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div>
                <strong>Olimpiadas Peru</strong>
                <div class="muted">Plataforma de gestion deportiva</div>
            </div>
        </div>

        <h1>Bienvenido al panel deportivo</h1>
        <p>Administra instituciones, equipos, programacion de partidos, resultados y seguimiento del campeonato desde un solo lugar.</p>

        <?php if ($errorMessage !== ''): ?>
            <div class="notice notice--error"><?= e($errorMessage) ?></div>
        <?php endif; ?>

        <?php if ($registered): ?>
            <div class="notice notice--success">La cuenta se registro correctamente. Ya puedes iniciar sesion.</div>
        <?php endif; ?>

        <?php if ($passwordReset): ?>
            <div class="notice notice--success">La contrasena se actualizo correctamente. Ingresa con tu nueva clave.</div>
        <?php endif; ?>

        <form class="auth-form" action="<?= e(app_url('login.php')) ?>" method="POST">
            <div class="field">
                <label for="email">Correo institucional</label>
                <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="field">
                <label for="password">Contrasena</label>
                <input id="password" type="password" name="password" placeholder="Ingresa tu contrasena" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-right-to-bracket"></i>
                Iniciar sesion
            </button>
        </form>

        <div class="auth-links">
            <a href="<?= e(app_url('registro.php')) ?>">Crear cuenta de institucion</a>
            <a href="<?= e(app_url('recuperar.php')) ?>">Recuperar contrasena</a>
        </div>
    </section>
</div>
</body>
</html>
