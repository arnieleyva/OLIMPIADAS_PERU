<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php

include '../../config/database.php';
include '../../includes/header.php';

$sql="

SELECT

p.id_partido,
e1.nombre AS local,
e2.nombre AS visitante,
p.fecha,
p.lugar,
p.estado,

e1.capitan,
e1.telefono_capitan

FROM partidos p

INNER JOIN equipos e1
ON p.equipo_local=e1.id_equipo

INNER JOIN equipos e2
ON p.equipo_visitante=e2.id_equipo

ORDER BY p.fecha ASC

";

$stmt=$conexion->prepare($sql);
$stmt->execute();

$partidos=$stmt->fetchAll();

?>

<style>

.panel{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.1);
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#001f4d;
color:white;
padding:12px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

.btn{
padding:8px 12px;
text-decoration:none;
border-radius:8px;
color:white;
}

.btn-success{
background:#28a745;
}

.titulo{
font-size:28px;
margin-bottom:20px;
color:#001f4d;
}

</style>

<div class="panel">

<h1 class="titulo">
📅 Programación de Partidos
</h1>

<table>

<tr>

<th>ID</th>
<th>Partido</th>
<th>Fecha y Hora</th>
<th>Lugar</th>
<th>Estado</th>
<th>Capitán</th>
<th>WhatsApp</th>
<th>Acciones</th>

</tr>

<?php foreach($partidos as $p){ ?>

<tr>

<td>
<?= $p['id_partido']; ?>
</td>

<td>
<?= $p['local']; ?>
 VS
 <?= $p['visitante']; ?>
</td>

<td>
<?= $p['fecha']; ?>
</td>

<td>
<?= $p['lugar']; ?>
</td>

<td>
<?= $p['estado']; ?>
</td>

<td>
<?= $p['capitan']; ?>
</td>

<td>

<a class="btn btn-success"

target="_blank"

href="https://wa.me/51<?= $p['telefono_capitan']; ?>?text=🏆 Olimpiadas PERU%0A%0AHola <?= urlencode($p['capitan']); ?>,%20tu%20equipo%20<?= urlencode($p['local']); ?>%20jugará%20contra%20<?= urlencode($p['visitante']); ?>%20el%20día%20<?= urlencode($p['fecha']); ?>%20en%20<?= urlencode($p['lugar']); ?>">

📲 Notificar

</a>


<td>

<a class="btn btn-primary"
href="editar.php?id=<?= $p['id_partido']; ?>">
✏ Editar
</a>

<a class="btn btn-danger"
onclick="return confirm('¿Eliminar partido?')"
href="eliminar.php?id=<?= $p['id_partido']; ?>">
🗑 Eliminar
</a>

<a class="btn btn-success"
target="_blank"
href="https://wa.me/51<?= $p['telefono_capitan']; ?>">
📲 WhatsApp
</a>

</td>

</td>

</tr>



<?php } ?>

</table>

</div>

<?php include '../../includes/footer.php'; ?>
