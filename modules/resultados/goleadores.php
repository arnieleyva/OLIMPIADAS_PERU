<?php
require __DIR__ . '/goleadores_view.php';
return;
?>

<?php

include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/footer.php';


$sql="

SELECT

j.nombres,
j.apellidos,
e.nombre equipo,
es.goles

FROM estadisticas es

INNER JOIN jugadores j
ON es.id_jugador=j.id_jugador

INNER JOIN equipos e
ON j.id_equipo=e.id_equipo

ORDER BY es.goles DESC

LIMIT 10

";

$stmt=$conexion->prepare($sql);
$stmt->execute();

$datos=$stmt->fetchAll();

?>

<h2>⚽ Top 10 Goleadores</h2>

<table class="table">

<tr>

<th>Jugador</th>
<th>Equipo</th>
<th>Goles</th>

</tr>

<?php foreach($datos as $fila){ ?>

<tr>

<td>
<?= $fila['nombres']." ".$fila['apellidos']; ?>
</td>

<td>
<?= $fila['equipo']; ?>
</td>

<td>
<?= $fila['goles']; ?>
</td>

</tr>

<?php } ?>

</table>

<?php include '../../includes/footer.php'; ?>
