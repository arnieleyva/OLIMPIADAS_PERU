<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('INSERT INTO arbitros (nombres, apellidos, telefono, experiencia) VALUES (?, ?, ?, ?)');
$stmt->execute([
    trim((string) ($_POST['nombres'] ?? '')),
    trim((string) ($_POST['apellidos'] ?? '')),
    trim((string) ($_POST['telefono'] ?? '')) ?: null,
    trim((string) ($_POST['experiencia'] ?? '')) ?: null,
]);
header('Location: index.php');
return;
?>
