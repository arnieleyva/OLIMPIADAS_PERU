<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php
$pageTitle = 'Resultados';
$pageHeading = 'Resultados y estadisticas';
$pageDescription = 'Consulta marcadores recientes, posiciones y visualizaciones generales del campeonato.';
$activeMenu = 'resultados';
?>

<?php

include '../../config/database.php';
include '../../includes/header.php';

/* ESTADISTICAS */

$totalPartidos = $conexion->query("
SELECT COUNT(*) total
FROM partidos
")->fetch()['total'];

$totalEquipos = $conexion->query("
SELECT COUNT(*) total
FROM equipos
")->fetch()['total'];

$totalResultados = $conexion->query("
SELECT COUNT(*) total
FROM resultados
")->fetch()['total'];

$totalJugadores = $conexion->query("
SELECT COUNT(*) total
FROM jugadores
")->fetch()['total'];

/* RESULTADOS */

$sql = "

SELECT

r.id_resultado,

e1.nombre AS local,

e2.nombre AS visitante,

r.marcador_local,

r.marcador_visitante,

r.ganador

FROM resultados r

INNER JOIN partidos p
ON r.id_partido = p.id_partido

INNER JOIN equipos e1
ON p.equipo_local = e1.id_equipo

INNER JOIN equipos e2
ON p.equipo_visitante = e2.id_equipo

ORDER BY r.id_resultado DESC

";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$datos = $stmt->fetchAll();

?>

<style>

.cards{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:25px;
}

.estadistica{
padding:25px;
border-radius:15px;
color:white;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.estadistica h2{
font-size:40px;
margin-bottom:10px;
}

.azul{
background:linear-gradient(135deg,#0047ff,#00a2ff);
}

.verde{
background:linear-gradient(135deg,#00b894,#00d084);
}

.naranja{
background:linear-gradient(135deg,#f39c12,#f1c40f);
}

.rojo{
background:linear-gradient(135deg,#e74c3c,#ff6b6b);
}

.panel{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0px 5px 15px rgba(0,0,0,.1);
margin-bottom:25px;
}

.tabla{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

.tabla th{
background:#001f4d;
color:white;
padding:15px;
}

.tabla td{
padding:12px;
border-bottom:1px solid #ddd;
}

.tabla tr:hover{
background:#f5f8ff;
}

.btn{
padding:10px 15px;
border-radius:8px;
text-decoration:none;
display:inline-block;
margin-right:5px;
color:white;
font-weight:bold;
}

.btn-success{
background:#00b894;
}

.btn-primary{
background:#001f4d;
}

.btn-warning{
background:#f1c40f;
color:black;
}

.btn-danger{
background:#e74c3c;
}

.titulo{
font-size:30px;
color:#001f4d;
margin-bottom:20px;
}

</style>

<div class="panel">

<h1 class="titulo">
🏆 Copa Mundial Escolar - Resultados
</h1>

<div class="cards">

<div class="estadistica azul">
<h2><?= $totalPartidos ?></h2>
<p>⚽ Partidos</p>
</div>

<div class="estadistica verde">
<h2><?= $totalEquipos ?></h2>
<p>🏆 Equipos</p>
</div>

<div class="estadistica naranja">
<h2><?= $totalResultados ?></h2>
<p>📋 Resultados</p>
</div>

<div class="estadistica rojo">
<h2><?= $totalJugadores ?></h2>
<p>👥 Jugadores</p>
</div>

</div>

<a href="crear.php" class="btn btn-success">
➕ Nuevo Resultado
</a>

<a href="posiciones.php" class="btn btn-primary">
🏆 Posiciones
</a>

<a href="goleadores.php" class="btn btn-primary">
⚽ Goleadores
</a>

<a href="../../dashboard.php" class="btn btn-primary">
🏠 Inicio
</a>

</div>

<div class="panel">

<h2>
🌎 Últimos Resultados
</h2>

<table class="tabla">

<tr>

<th>ID</th>
<th>Partido</th>
<th>Marcador</th>
<th>Ganador</th>
<th>Acciones</th>

</tr>

<?php foreach($datos as $fila){ ?>

<tr>

<td>
<?= $fila['id_resultado']; ?>
</td>

<td>
<?= $fila['local']; ?>
VS
<?= $fila['visitante']; ?>
</td>

<td>
<strong>
<?= $fila['marcador_local']; ?>
-
<?= $fila['marcador_visitante']; ?>
</strong>
</td>

<td>
🏆 <?= $fila['ganador']; ?>
</td>

<td>

<a class="btn btn-warning"
href="editar.php?id=<?= $fila['id_resultado']; ?>">
✏ Editar
</a>

<a class="btn btn-danger"
onclick="return confirm('¿Eliminar resultado?')"
href="eliminar.php?id=<?= $fila['id_resultado']; ?>">
🗑 Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<div class="panel">

<h2>
📊 Estadísticas Generales
</h2>

<canvas id="graficoResultados"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('graficoResultados'),
{
type:'doughnut',

data:{

labels:[
'Partidos',
'Equipos',
'Resultados',
'Jugadores'
],

datasets:[{

data:[

<?= $totalPartidos ?>,
<?= $totalEquipos ?>,
<?= $totalResultados ?>,
<?= $totalJugadores ?>

]

}]

}

});

</script>

<?php include '../../includes/footer.php'; ?>
