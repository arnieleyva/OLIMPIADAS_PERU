<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$equipoLocal = (int) ($_POST['equipo_local'] ?? 0);
$equipoVisitante = (int) ($_POST['equipo_visitante'] ?? 0);

if ($equipoLocal === $equipoVisitante) {
    header('Location: crear.php');
    return;
}

$stmt = $conexion->prepare('
    INSERT INTO partidos (
        id_evento,
        id_deporte,
        equipo_local,
        equipo_visitante,
        id_arbitro,
        fecha,
        lugar,
        estado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
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
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$sql = "INSERT INTO partidos(

id_evento,
id_deporte,
equipo_local,
equipo_visitante,
fecha,
lugar,
estado

)

VALUES(?,?,?,?,?,?,?)";

$stmt = $conexion->prepare($sql);

$stmt->execute([

1, // Evento Olimpiadas PERU 2026

1, // Futbol

$_POST['equipo_local'],
$_POST['equipo_visitante'],
$_POST['fecha'],
$_POST['lugar'],
'Pendiente'

]);

header("Location:index.php");

?>s
