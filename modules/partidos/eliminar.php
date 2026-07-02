<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {
    $stmt = $conexion->prepare('DELETE FROM partidos WHERE id_partido = ?');
    $stmt->execute([$id]);
}

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

$stmt = $conexion->prepare(
"DELETE FROM partidos
WHERE id_partido=?"
);

$stmt->execute([$id]);

header("Location:index.php");

?>
