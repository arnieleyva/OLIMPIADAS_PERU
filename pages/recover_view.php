<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperar cuenta | Olimpiadas Peru</title>
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
                <i class="fa-solid fa-key"></i>
            </div>
            <div>
                <strong>Recuperacion segura</strong>
                <div class="muted">Genera un nuevo enlace de acceso</div>
            </div>
        </div>

        <h1>Restablecer contrasena</h1>
        <p>Ingresa el correo registrado. Se generara un enlace temporal para actualizar la contrasena.</p>

        <form class="auth-form" action="<?= e(app_url('enviar_recuperacion.php')) ?>" method="POST">
            <div class="field">
                <label for="email">Correo registrado</label>
                <input id="email" type="email" name="email" placeholder="correo@institucion.com" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-paper-plane"></i>
                Generar enlace
            </button>
        </form>

        <div class="auth-links">
            <a href="<?= e(app_url('index.php')) ?>">Volver al inicio</a>
        </div>
    </section>
</div>
</body>
</html>
