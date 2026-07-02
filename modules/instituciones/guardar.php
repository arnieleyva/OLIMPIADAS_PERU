<?php
include '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); return; }
$stmt = $conexion->prepare('INSERT INTO instituciones (nombre, ruc, direccion, telefono, email, representante) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([
    trim((string) ($_POST['nombre'] ?? '')),
    trim((string) ($_POST['ruc'] ?? '')) ?: null,
    trim((string) ($_POST['direccion'] ?? '')) ?: null,
    trim((string) ($_POST['telefono'] ?? '')) ?: null,
    trim((string) ($_POST['email'] ?? '')) ?: null,
    trim((string) ($_POST['representante'] ?? '')) ?: null,
]);
header('Location: index.php');
return;
?>
