<?php

include '../../config/database.php';

$id = $_GET['id'];

try{

    $conexion->beginTransaction();

    /* ELIMINAR RESULTADOS */

    $stmt = $conexion->prepare("
    DELETE FROM resultados
    WHERE id_partido=?
    ");

    $stmt->execute([$id]);

    /* ELIMINAR PARTIDO */

    $stmt = $conexion->prepare("
    DELETE FROM partidos
    WHERE id_partido=?
    ");

    $stmt->execute([$id]);

    $conexion->commit();

    header("Location:index.php");
    exit();

}catch(Exception $e){

    $conexion->rollBack();

    echo "Error: ".$e->getMessage();

}
?>