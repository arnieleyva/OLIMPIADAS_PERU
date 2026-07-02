<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$stmt = $conexion->prepare('
    UPDATE equipos
    SET
        nombre = ?,
        director_tecnico = ?,
        id_institucion = ?,
        id_deporte = ?,
        id_categoria = ?,
        capitan = ?,
        telefono_capitan = ?
    WHERE id_equipo = ?
');
//
$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['director_tecnico'] ?? '')) ?: null,
    (int) ($_POST['id_institucion'] ?? 1),
    (int) ($_POST['id_deporte'] ?? 1),
    (int) ($_POST['id_categoria'] ?? 1),
    trim((string) ($_POST['capitan'] ?? '')) ?: null,
    trim((string) ($_POST['telefono_capitan'] ?? '')) ?: null,
    (int) ($_POST['id'] ?? 0),
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$sql = "UPDATE equipos SET
nombre = ?,
id_institucion = ?,
id_deporte = ?,
id_categoria = ?
WHERE id_equipo = ?";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$_POST['nombre'],
$_POST['id_institucion'],
$_POST['id_deporte'],
$_POST['id_categoria'],
$_POST['id_equipo']

]);

header("Location:index.php");
exit();

?>
