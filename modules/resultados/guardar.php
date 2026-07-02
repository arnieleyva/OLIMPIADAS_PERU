<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:index.php');
    exit();
}

$id_partido = (int) ($_POST['id_partido'] ?? 0);
$marcador_local = (int) ($_POST['marcador_local'] ?? 0);
$marcador_visitante = (int) ($_POST['marcador_visitante'] ?? 0);
$observaciones = trim((string) ($_POST['observaciones'] ?? '')) ?: null;

if($marcador_local > $marcador_visitante){

    $ganador = "Local";

}elseif($marcador_visitante > $marcador_local){

    $ganador = "Visitante";

}else{

    $ganador = "Empate";

}

$stmt = $conexion->prepare('SELECT id_resultado FROM resultados WHERE id_partido = ? LIMIT 1');
$stmt->execute([$id_partido]);
$existente = $stmt->fetchColumn();

if ($existente) {
    $stmt = $conexion->prepare('UPDATE resultados SET marcador_local = ?, marcador_visitante = ?, ganador = ?, observaciones = ? WHERE id_partido = ?');
    $stmt->execute([$marcador_local, $marcador_visitante, $ganador, $observaciones, $id_partido]);
} else {
    $stmt = $conexion->prepare('INSERT INTO resultados (id_partido, marcador_local, marcador_visitante, ganador, observaciones) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id_partido, $marcador_local, $marcador_visitante, $ganador, $observaciones]);
}

$conexion->prepare("UPDATE partidos SET estado = 'Finalizado' WHERE id_partido = ?")->execute([$id_partido]);

$conexion->prepare('INSERT INTO notificaciones (titulo, mensaje) VALUES (?, ?)')->execute([
    'Resultado actualizado',
    'Se registró el resultado del partido #' . $id_partido . ' con marcador ' . $marcador_local . ' - ' . $marcador_visitante . '.',
]);

header("Location:index.php");
exit();

?>
