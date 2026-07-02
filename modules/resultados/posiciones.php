<?php require __DIR__ . '/posiciones_view.php'; return; ?>

<?php
$pageTitle = 'Tabla de posiciones';
$pageHeading = 'Posiciones del campeonato';
$pageDescription = 'Resumen consolidado de partidos jugados, victorias y diferencia de goles por equipo.';
$activeMenu = 'resultados';
?>

<?php

include '../../config/database.php';
include '../../includes/header.php';

$sql="

SELECT

e.nombre,

COUNT(r.id_resultado) AS PJ,

SUM(
CASE
WHEN (
(p.equipo_local=e.id_equipo AND r.marcador_local>r.marcador_visitante)
OR
(p.equipo_visitante=e.id_equipo AND r.marcador_visitante>r.marcador_local)
)
THEN 1 ELSE 0
END
) AS PG,

SUM(
CASE
WHEN r.marcador_local=r.marcador_visitante
THEN 1 ELSE 0
END
) AS PE,

SUM(
CASE
WHEN (
(p.equipo_local=e.id_equipo AND r.marcador_local<r.marcador_visitante)
OR
(p.equipo_visitante=e.id_equipo AND r.marcador_visitante<r.marcador_local)
)
THEN 1 ELSE 0
END
) AS PP,

SUM(
CASE
WHEN p.equipo_local=e.id_equipo
THEN r.marcador_local
ELSE r.marcador_visitante
END
) AS GF,

SUM(
CASE
WHEN p.equipo_local=e.id_equipo
THEN r.marcador_visitante
ELSE r.marcador_local
END
) AS GC

FROM equipos e

LEFT JOIN partidos p
ON (
e.id_equipo=p.equipo_local
OR
e.id_equipo=p.equipo_visitante
)

LEFT JOIN resultados r
ON p.id_partido=r.id_partido

GROUP BY e.id_equipo

ORDER BY PG DESC

";

$stmt=$conexion->prepare($sql);
$stmt->execute();

$datos=$stmt->fetchAll();

?>

<h2>🏆 Tabla de Posiciones</h2>

<table class="table">

<tr>

<th>Equipo</th>
<th>PJ</th>
<th>PG</th>
<th>PE</th>
<th>PP</th>
<th>GF</th>
<th>GC</th>

</tr>

<?php foreach($datos as $fila){ ?>

<tr>

<td><?= $fila['nombre'] ?></td>
<td><?= $fila['PJ'] ?></td>
<td><?= $fila['PG'] ?></td>
<td><?= $fila['PE'] ?></td>
<td><?= $fila['PP'] ?></td>
<td><?= $fila['GF'] ?></td>
<td><?= $fila['GC'] ?></td>

</tr>

<?php } ?>

</table>

<?php include '../../includes/footer.php'; ?>
