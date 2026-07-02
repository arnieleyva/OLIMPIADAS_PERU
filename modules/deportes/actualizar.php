<?php

include '../../config/database.php';

$sql = "UPDATE deportes
SET nombre=?, tipo=?
WHERE id_deporte=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$_POST['nombre'],
$_POST['tipo'],
$_POST['id']

]);

header("Location:index.php");
exit();