<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
try {
    $stmt = $conexion->prepare('DELETE FROM eventos WHERE id_evento = ?');
    $stmt->execute([(int) ($_POST['id'] ?? 0)]);
} catch (PDOException $e) {
}
header('Location: index.php');
return;
?>
