<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:index.php');
    exit();
}

$local = (int) ($_POST['marcador_local'] ?? 0);
$visitante = (int) ($_POST['marcador_visitante'] ?? 0);

if($local > $visitante){

    $ganador = "Local";

}elseif($visitante > $local){

    $ganador = "Visitante";

}else{

    $ganador = "Empate";

}

$sql = "

UPDATE resultados

SET

marcador_local=?,
marcador_visitante=?,
ganador=?,
observaciones=?

WHERE id_resultado=?

";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$local,
$visitante,
$ganador,
$_POST['observaciones'],
$_POST['id_resultado']

]);

$stmt = $conexion->prepare('SELECT id_partido FROM resultados WHERE id_resultado = ?');
$stmt->execute([(int) $_POST['id_resultado']]);
$idPartido = (int) $stmt->fetchColumn();

if ($idPartido > 0) {
    $conexion->prepare("UPDATE partidos SET estado = 'Finalizado' WHERE id_partido = ?")->execute([$idPartido]);
}

header("Location:index.php");
exit();
