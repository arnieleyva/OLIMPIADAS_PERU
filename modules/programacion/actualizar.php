<?php

include '../../config/database.php';

$sql="

UPDATE partidos

SET

fecha=?,
lugar=?,
estado=?

WHERE id_partido=?

";

$stmt=$conexion->prepare($sql);

$stmt->execute([

$_POST['fecha'],
$_POST['lugar'],
$_POST['estado'],
$_POST['id_partido']

]);

header("Location:index.php");
exit();