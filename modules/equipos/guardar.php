<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$stmt = $conexion->prepare('
    INSERT INTO equipos (
        nombre,
        director_tecnico,
        id_institucion,
        id_deporte,
        id_categoria,
        capitan,
        telefono_capitan
    ) VALUES (?, ?, ?, ?, ?, ?, ?)
');

$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['director_tecnico'] ?? '')) ?: null,
    (int) ($_POST['id_institucion'] ?? 1),
    (int) ($_POST['id_deporte'] ?? 1),
    (int) ($_POST['id_categoria'] ?? 1),
    trim((string) ($_POST['capitan'] ?? '')) ?: null,
    trim((string) ($_POST['telefono_capitan'] ?? '')) ?: null,
]);

header('Location: index.php');
return;
?>

|<?php

include '../../config/database.php';

$nombre = $_POST['nombre'];

$id_deporte = $_POST['id_deporte'];

$sql = "INSERT INTO equipos
(nombre,id_deporte,id_institucion,id_categoria)

VALUES
(?,?,1,1)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    $nombre,
    $id_deporte
]);

header("Location:index.php");

?>
