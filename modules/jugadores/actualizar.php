<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$stmt = $conexion->prepare('
    UPDATE jugadores
    SET
        id_equipo = ?,
        nombres = ?,
        apellidos = ?,
        dni = ?,
        edad = ?,
        genero = ?,
        numero_camiseta = ?,
        posicion = ?
    WHERE id_jugador = ?
');

$stmt->execute([
    (int) ($_POST['id_equipo'] ?? 0),
    trim((string) ($_POST['nombres'] ?? '')),
    trim((string) ($_POST['apellidos'] ?? '')),
    trim((string) ($_POST['dni'] ?? '')) ?: null,
    ($_POST['edad'] ?? '') !== '' ? (int) $_POST['edad'] : null,
    trim((string) ($_POST['genero'] ?? '')) ?: null,
    ($_POST['numero_camiseta'] ?? '') !== '' ? (int) $_POST['numero_camiseta'] : null,
    trim((string) ($_POST['posicion'] ?? '')) ?: null,
    (int) ($_POST['id'] ?? 0),
]);

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$id = $_POST['id'];
$id_equipo = $_POST['id_equipo'];

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$dni = $_POST['dni'];
$edad = $_POST['edad'];

$genero = $_POST['genero'];

$numero_camiseta = $_POST['numero_camiseta'];

$posicion = $_POST['posicion'];

$sql = "UPDATE jugadores SET

id_equipo=?,
nombres=?,
apellidos=?,
dni=?,
edad=?,
genero=?,
numero_camiseta=?,
posicion=?

WHERE id_jugador=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([

$id_equipo,
$nombres,
$apellidos,
$dni,
$edad,
$genero,
$numero_camiseta,
$posicion,
$id

]);

header("Location:index.php");

?>
