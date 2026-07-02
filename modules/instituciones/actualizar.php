<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('UPDATE instituciones SET nombre = ?, ruc = ?, direccion = ?, telefono = ?, email = ?, representante = ? WHERE id_institucion = ?');
$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['ruc'] ?? '')) ?: null,
    trim((string) ($_POST['direccion'] ?? '')) ?: null,
    trim((string) ($_POST['telefono'] ?? '')) ?: null,
    trim((string) ($_POST['email'] ?? '')) ?: null,
    trim((string) ($_POST['representante'] ?? '')) ?: null,
    (int) ($_POST['id'] ?? 0),
]);
header('Location: index.php');
return;
?>
