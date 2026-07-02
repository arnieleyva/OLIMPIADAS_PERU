<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$id = (int) ($_POST['id'] ?? 0);
$nombre = trim((string) ($_POST['nombre'] ?? ''));
$apellido = trim((string) ($_POST['apellido'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$telefono = trim((string) ($_POST['telefono'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$idRol = (int) ($_POST['id_rol'] ?? 2);

if ($password !== '') {
    $sql = '
        UPDATE usuarios
        SET nombre = ?, apellido = ?, email = ?, telefono = ?, id_rol = ?, password_hash = ?
        WHERE id_usuario = ?
    ';

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        $nombre,
        $apellido,
        $email,
        $telefono !== '' ? $telefono : null,
        $idRol,
        password_hash($password, PASSWORD_DEFAULT),
        $id,
    ]);
} else {
    $sql = '
        UPDATE usuarios
        SET nombre = ?, apellido = ?, email = ?, telefono = ?, id_rol = ?
        WHERE id_usuario = ?
    ';

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        $nombre,
        $apellido,
        $email,
        $telefono !== '' ? $telefono : null,
        $idRol,
        $id,
    ]);
}

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$id = $_POST['id'];

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$sql = "UPDATE usuarios
SET nombre=?,
apellido=?,
email=?
WHERE id_usuario=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([
$nombre,
$apellido,
$email,
$id
]);

header("Location:index.php");

?>
