<?php
include '../../config/database.php';

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];

$sql = "INSERT INTO deportes(nombre,tipo) VALUES(?,?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$nombre,$tipo]);

header("Location:index.php");
?>