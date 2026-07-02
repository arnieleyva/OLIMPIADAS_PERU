<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('UPDATE arbitros SET nombres = ?, apellidos = ?, telefono = ?, experiencia = ? WHERE id_arbitro = ?');
$stmt->execute([
    trim((string) ($_POST['nombres'] ?? '')),
    trim((string) ($_POST['apellidos'] ?? '')),
    trim((string) ($_POST['telefono'] ?? '')) ?: null,
    trim((string) ($_POST['experiencia'] ?? '')) ?: null,
    (int) ($_POST['id'] ?? 0),
]);
header('Location: index.php');
return;
?>
