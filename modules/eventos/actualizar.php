<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('UPDATE eventos SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, estado = ? WHERE id_evento = ?');
$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['descripcion'] ?? '')) ?: null,
    trim((string) ($_POST['fecha_inicio'] ?? '')) ?: null,
    trim((string) ($_POST['fecha_fin'] ?? '')) ?: null,
    trim((string) ($_POST['estado'] ?? 'Pendiente')) ?: 'Pendiente',
    (int) ($_POST['id'] ?? 0),
]);
header('Location: index.php');
return;
?>
