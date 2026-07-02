<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('INSERT INTO eventos (nombre, descripcion, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['descripcion'] ?? '')) ?: null,
    trim((string) ($_POST['fecha_inicio'] ?? '')) ?: null,
    trim((string) ($_POST['fecha_fin'] ?? '')) ?: null,
    trim((string) ($_POST['estado'] ?? 'Pendiente')) ?: 'Pendiente',
]);
header('Location: index.php');
return;
?>
