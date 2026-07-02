<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$nombre = trim((string) ($_POST['nombre'] ?? ''));
$apellido = trim((string) ($_POST['apellido'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$telefono = trim((string) ($_POST['telefono'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$idRol = (int) ($_POST['id_rol'] ?? 2);

$stmt = $conexion->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ?');
$stmt->execute([$email]);

if ((int) $stmt->fetchColumn() > 0) {
    header('Location: crear.php');
    return;
}

$stmt = $conexion->prepare('
    INSERT INTO usuarios (
        nombre,
        apellido,
        email,
        password_hash,
        telefono,
        id_rol
    ) VALUES (?, ?, ?, ?, ?, ?)
');

$stmt->execute([
    $nombre,
    $apellido,
    $email,
    password_hash($password, PASSWORD_DEFAULT),
    $telefono !== '' ? $telefono : null,
    $idRol,
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$password = password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$id_rol = $_POST['id_rol'];

$sql = "INSERT INTO usuarios(
nombre,
apellido,
email,
password_hash,
id_rol
)
VALUES(?,?,?,?,?)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
$nombre,
$apellido,
$email,
$password,
$id_rol
]);

header("Location:index.php");

?>
