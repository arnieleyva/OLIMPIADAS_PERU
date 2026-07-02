<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$stmt = $conexion->prepare('
    INSERT INTO jugadores (
        id_equipo,
        nombres,
        apellidos,
        dni,
        edad,
        genero,
        numero_camiseta,
        posicion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
');

$stmt->execute([
    (int) ($_POST['id_equipo'] ?? 0),
    trim((string) ($_POST['nombres'] ?? '')),
    trim((string) ($_POST['apellidos'] ?? '')),
    trim((string) ($_POST['dni'] ?? '')) ?: null,
    ($_POST['edad'] ?? '') !== '' ? (int) $_POST['edad'] : null,
    trim((string) ($_POST['genero'] ?? '')) ?: null,
    ($_POST['numero_camiseta'] ?? '') !== '' ? (int) $_POST['numero_camiseta'] : null,
    trim((string) ($_POST['posicion'] ?? '')) ?: null,
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$sql = "INSERT INTO jugadores
(id_equipo,nombres,apellidos,numero_camiseta)

VALUES(?,?,?,?)";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$_POST['id_equipo'],
$_POST['nombre'],
$_POST['apellido'],
$_POST['numero_camiseta']

]);

header("Location:index.php");

?>
