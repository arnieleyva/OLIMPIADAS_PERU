<?php

require_once __DIR__ . '/auth.php';

require_login();

$pageTitle = $pageTitle ?? 'Olimpiadas Peru';
$pageHeading = $pageHeading ?? $pageTitle;
$pageDescription = $pageDescription ?? 'Gestion integral de equipos, partidos, programacion y resultados deportivos.';
$activeMenu = $activeMenu ?? 'panel';
$pageContentClass = $pageContentClass ?? '';

$menuItems = [
    [
        'key' => 'panel',
        'label' => 'Panel',
        'icon' => 'fa-solid fa-house',
        'href' => app_url('panel.php'),
    ],
    [
        'key' => 'instituciones',
        'label' => 'Instituciones',
        'icon' => 'fa-solid fa-building-columns',
        'href' => app_url('modules/instituciones/index.php'),
    ],
    [
        'key' => 'eventos',
        'label' => 'Eventos',
        'icon' => 'fa-solid fa-flag-checkered',
        'href' => app_url('modules/eventos/index.php'),
    ],
    [
        'key' => 'arbitros',
        'label' => 'Arbitros',
        'icon' => 'fa-solid fa-user-tie',
        'href' => app_url('modules/arbitros/index.php'),
    ],
    [
        'key' => 'usuarios',
        'label' => 'Usuarios',
        'icon' => 'fa-solid fa-users',
        'href' => app_url('modules/usuarios/index.php'),
        'adminOnly' => true,
    ],
    [
        'key' => 'deportes',
        'label' => 'Deportes',
        'icon' => 'fa-solid fa-volleyball',
        'href' => app_url('modules/deportes/index.php'),
    ],
    [
        'key' => 'equipos',
        'label' => 'Equipos',
        'icon' => 'fa-solid fa-shield-halved',
        'href' => app_url('modules/equipos/index.php'),
    ],
    [
        'key' => 'jugadores',
        'label' => 'Jugadores',
        'icon' => 'fa-solid fa-user-group',
        'href' => app_url('modules/jugadores/index.php'),
    ],
    [
        'key' => 'partidos',
        'label' => 'Partidos',
        'icon' => 'fa-regular fa-calendar',
        'href' => app_url('modules/partidos/index.php'),
    ],
    [
        'key' => 'programacion',
        'label' => 'Programacion',
        'icon' => 'fa-brands fa-whatsapp',
        'href' => app_url('modules/programacion/index.php'),
    ],
    [
        'key' => 'resultados',
        'label' => 'Resultados',
        'icon' => 'fa-solid fa-chart-line',
        'href' => app_url('modules/resultados/index.php'),
    ],
    [
        'key' => 'notificaciones',
        'label' => 'Notificaciones',
        'icon' => 'fa-solid fa-bell',
        'href' => app_url('modules/notificaciones/index.php'),
    ],
    [
        'key' => 'reportes',
        'label' => 'Reportes',
        'icon' => 'fa-solid fa-file-export',
        'href' => app_url('modules/reportes/index.php'),
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> | Olimpiadas Peru</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?= e(asset_url('css/style.css')) ?>">
</head>
<body>
<div class="app-shell">
    <aside class="app-sidebar">
        <div class="app-brand">
            <div class="app-brand__logo">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div>
                <div class="app-brand__title">Olimpiadas Peru</div>
                <div class="app-brand__subtitle">Sistema de gestion deportiva</div>
            </div>
        </div>

        <nav class="app-nav">
            <div class="app-nav__section">Navegacion</div>
            <?php foreach ($menuItems as $item): ?>
                <?php if (!empty($item['adminOnly']) && !is_admin()) { continue; } ?>
                <a href="<?= e($item['href']) ?>" class="<?= $activeMenu === $item['key'] ? 'is-active' : '' ?>">
                    <i class="<?= e($item['icon']) ?>"></i>
                    <span><?= e($item['label']) ?></span>
                </a>
            <?php endforeach; ?>

            <div class="app-nav__section">Cuenta</div>
            <a href="<?= e(app_url('logout.php')) ?>">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesion</span>
            </a>
        </nav>
    </aside>

    <div class="app-content <?= e($pageContentClass) ?>">
        <header class="app-topbar">
            <div>
                <div class="eyebrow">Administracion del torneo</div>
                <h1 class="app-topbar__title"><?= e($pageHeading) ?></h1>
                <p class="app-topbar__subtitle"><?= e($pageDescription) ?></p>
            </div>

            <div class="app-topbar__meta">
                <div class="app-topbar__user"><?= e(current_user_name()) ?></div>
                <div><?= e(current_role_label()) ?></div>
                <a class="btn btn-secondary" href="<?= e(app_url('panel.php')) ?>">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver al panel
                </a>
            </div>
        </header>

        <main class="content-grid">
