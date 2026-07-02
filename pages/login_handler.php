<?php

include dirname(__DIR__) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . app_url('index.php'));
    exit();
}

$email = trim((string) ($_POST['email'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    header('Location: ' . app_url('index.php') . '?error=' . urlencode('Completa tu correo y contrasena.'));
    exit();
}

$sql = '
    SELECT u.*, r.nombre AS rol_nombre
    FROM usuarios u
    INNER JOIN roles r ON u.id_rol = r.id_rol
    WHERE u.email = ?
    LIMIT 1
';

$stmt = $conexion->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if (!$usuario || !password_verify($password, $usuario['password_hash'])) {
    header('Location: ' . app_url('index.php') . '?error=' . urlencode('Correo o contrasena incorrectos.'));
    exit();
}

if (isset($usuario['activo']) && (int) $usuario['activo'] !== 1) {
    header('Location: ' . app_url('index.php') . '?error=' . urlencode('La cuenta se encuentra inactiva.'));
    exit();
}

session_regenerate_id(true);

$_SESSION['id_usuario'] = (int) $usuario['id_usuario'];
$_SESSION['usuario'] = (string) $usuario['nombre'];
$_SESSION['nombre_completo'] = trim($usuario['nombre'] . ' ' . $usuario['apellido']);
$_SESSION['id_rol'] = (int) $usuario['id_rol'];
$_SESSION['rol_nombre'] = (string) $usuario['rol_nombre'];

header('Location: ' . app_url('panel.php'));
exit();
