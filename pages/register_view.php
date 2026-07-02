<?php

require_once dirname(__DIR__) . '/includes/auth.php';
include dirname(__DIR__) . '/config/database.php';

if (isset($_SESSION['usuario'])) {
    header('Location: ' . app_url('panel.php'));
    exit();
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $apellido = trim((string) ($_POST['apellido'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $telefono = trim((string) ($_POST['telefono'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($nombre === '' || $apellido === '' || $email === '' || $password === '') {
        $errorMessage = 'Completa todos los campos obligatorios.';
    } else {
        $stmt = $conexion->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);

        if ((int) $stmt->fetchColumn() > 0) {
            $errorMessage = 'El correo ya se encuentra registrado.';
        } else {
            $sql = '
                INSERT INTO usuarios (
                    nombre,
                    apellido,
                    email,
                    password_hash,
                    telefono,
                    id_rol
                ) VALUES (?, ?, ?, ?, ?, ?)
            ';

            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                $nombre,
                $apellido,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $telefono !== '' ? $telefono : null,
                2,
            ]);

            header('Location: ' . app_url('index.php') . '?registered=1');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro | Olimpiadas Peru</title>
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
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <div>
                <strong>Registro de institucion</strong>
                <div class="muted">Crea el acceso para administrar tu delegacion</div>
            </div>
        </div>

        <h1>Nueva cuenta</h1>
        <p>Este acceso se usa para registrar participantes, revisar programacion y consultar resultados del campeonato.</p>

        <?php if ($errorMessage !== ''): ?>
            <div class="notice notice--error"><?= e($errorMessage) ?></div>
        <?php endif; ?>

        <form class="auth-form" method="POST">
            <div class="form-grid form-grid--two">
                <div class="field">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" value="<?= e((string) ($_POST['nombre'] ?? '')) ?>" required>
                </div>

                <div class="field">
                    <label for="apellido">Apellido</label>
                    <input id="apellido" type="text" name="apellido" value="<?= e((string) ($_POST['apellido'] ?? '')) ?>" required>
                </div>
            </div>

            <div class="field">
                <label for="email">Correo</label>
                <input id="email" type="email" name="email" value="<?= e((string) ($_POST['email'] ?? '')) ?>" required>
            </div>

            <div class="field">
                <label for="telefono">Telefono</label>
                <input id="telefono" type="text" name="telefono" value="<?= e((string) ($_POST['telefono'] ?? '')) ?>" placeholder="Opcional">
            </div>

            <div class="field">
                <label for="password">Contrasena</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                Registrar cuenta
            </button>
        </form>

        <div class="auth-links">
            <a href="<?= e(app_url('index.php')) ?>">Volver al inicio de sesion</a>
        </div>
    </section>
</div>
</body>
</html>
