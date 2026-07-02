<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$equipoLocal = (int) ($_POST['equipo_local'] ?? 0);
$equipoVisitante = (int) ($_POST['equipo_visitante'] ?? 0);

if ($equipoLocal === $equipoVisitante) {
    header('Location: editar.php?id=' . (int) ($_POST['id'] ?? 0));
    return;
}

$stmt = $conexion->prepare('
    UPDATE partidos
    SET
        id_evento = ?,
        id_deporte = ?,
        equipo_local = ?,
        equipo_visitante = ?,
        id_arbitro = ?,
        fecha = ?,
        lugar = ?,
        estado = ?
    WHERE id_partido = ?
');

$stmt->execute([
    (int) ($_POST['id_evento'] ?? 1),
    (int) ($_POST['id_deporte'] ?? 1),
    $equipoLocal,
    $equipoVisitante,
    ($_POST['id_arbitro'] ?? '') !== '' ? (int) $_POST['id_arbitro'] : null,
    (string) ($_POST['fecha'] ?? ''),
    trim((string) ($_POST['lugar'] ?? '')),
    (string) ($_POST['estado'] ?? 'Pendiente'),
    (int) ($_POST['id'] ?? 0),
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$sql = "UPDATE partidos SET

id_evento=?,
id_deporte=?,
equipo_local=?,
equipo_visitante=?,
fecha=?,
lugar=?,
estado=?

WHERE id_partido=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$_POST['id_evento'],
$_POST['id_deporte'],
$_POST['equipo_local'],
$_POST['equipo_visitante'],
$_POST['fecha'],
$_POST['lugar'],
$_POST['estado'],
$_POST['id']

]);

header("Location:index.php");

?>
