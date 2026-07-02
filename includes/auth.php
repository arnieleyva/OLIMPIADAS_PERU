<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function app_url(string $path = ''): string
{
    $base = '/OLIMPIADAS_PERU';

    return $base . ($path !== '' ? '/' . ltrim($path, '/') : '');
}

function asset_url(string $path): string
{
    $cleanPath = ltrim($path, '/');
    $fullPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
    $version = is_file($fullPath) ? (string) filemtime($fullPath) : date('YmdHis');

    return app_url($cleanPath) . '?v=' . rawurlencode($version);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function require_login(): void
{
    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . app_url('index.php'));
        exit();
    }
}

function require_role(int ...$roles): void
{
    require_login();

    if ($roles === []) {
        return;
    }

    $currentRole = (int) ($_SESSION['id_rol'] ?? 0);

    if (!in_array($currentRole, $roles, true)) {
        http_response_code(403);
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Acceso restringido</title></head><body style="font-family:Manrope,Segoe UI,Arial,sans-serif;padding:40px;background:#f5f7fb;color:#0f172a;"><h1>Acceso restringido</h1><p>No tienes permisos para acceder a esta seccion.</p><p><a href="' . e(app_url('panel.php')) . '">Volver al panel</a></p></body></html>';
        exit();
    }
}

function is_admin(): bool
{
    return (int) ($_SESSION['id_rol'] ?? 0) === 1;
}

function current_user_name(): string
{
    $fullName = trim((string) ($_SESSION['nombre_completo'] ?? ''));

    if ($fullName !== '') {
        return $fullName;
    }

    return (string) ($_SESSION['usuario'] ?? 'Invitado');
}

function current_role_label(): string
{
    if (!empty($_SESSION['rol_nombre'])) {
        return (string) $_SESSION['rol_nombre'];
    }

    return is_admin() ? 'Administrador' : 'Institucion';
}

function current_request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

    return is_string($path) ? $path : '';
}
