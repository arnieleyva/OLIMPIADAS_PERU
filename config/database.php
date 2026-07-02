<?php

require_once dirname(__DIR__) . '/includes/auth.php';

if (PHP_SAPI !== 'cli') {
    $requestPath = current_request_path();
    $basePath = rtrim(app_url(), '/');
    $normalizedPath = rtrim($requestPath, '/');

    $publicRoutes = [
        $basePath,
        $basePath . '/',
        $basePath . '/index.php',
        $basePath . '/login.php',
        $basePath . '/registro.php',
        $basePath . '/recuperar.php',
        $basePath . '/enviar_recuperacion.php',
        $basePath . '/restablecer.php',
        $basePath . '/logout.php',
    ];

    $normalizedPublicRoutes = array_map(
        static fn(string $route): string => rtrim($route, '/'),
        $publicRoutes
    );

    if (!in_array($normalizedPath, $normalizedPublicRoutes, true)) {
        require_login();
    }

    if (str_contains($requestPath, '/modules/usuarios/')) {
        require_role(1);
    }
}

$host = "localhost";
$dbname = "olimpiadas_peru";
$user = "root";
$pass = "";

try{

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $conexion->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

}catch(PDOException $e){

    die("Error de conexión: " . $e->getMessage());

}

?>
