<?php
require __DIR__ . '/pages/panel_view.php';
return;
?>

<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location:index.php");
}

include 'config/database.php';

/* CONTADORES DASHBOARD */

$totalUsuarios = $conexion->query(
"SELECT COUNT(*) FROM usuarios"
)->fetchColumn();

$totalEquipos = $conexion->query(
"SELECT COUNT(*) FROM equipos"
)->fetchColumn();

$totalDeportes = $conexion->query(
"SELECT COUNT(*) FROM deportes"
)->fetchColumn();

$totalPartidos = $conexion->query(
"SELECT COUNT(*) FROM partidos"
)->fetchColumn();

/* ÚLTIMOS PARTIDOS */

$sql = "SELECT partidos.*, 

local.nombre AS equipo_local,
visitante.nombre AS equipo_visitante

FROM partidos

INNER JOIN equipos local
ON partidos.equipo_local = local.id_equipo

INNER JOIN equipos visitante
ON partidos.equipo_visitante = visitante.id_equipo

ORDER BY partidos.id_partido DESC
LIMIT 5";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$partidos = $stmt->fetchAll();

$totalGoles = $conexion->query("
SELECT SUM(goles)
FROM estadisticas
")->fetchColumn();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Olimpiadas</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    display:flex;
    background:#f4f4f4;
}

/* SIDEBAR */

.sidebar{
    width:250px;
    height:100vh;
    background:#001f4d;
    position:fixed;
    padding:20px;
}

.sidebar h2{
    color:white;
    margin-bottom:30px;
    text-align:center;
}

.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    margin-bottom:10px;
}

.sidebar ul li a{
    display:block;
    padding:15px;
    background:#003380;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.sidebar ul li a:hover{
    background:#0052cc;
}

/* MAIN */

.main{
    margin-left:250px;
    width:100%;
    padding:20px;
}

/* TOPBAR */

.topbar{
    background:white;
    padding:20px;
    border-radius:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0px 0px 10px rgba(0,0,0,0.1);
}

.topbar h1{
    color:#001f4d;
}

/* CARDS */

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-top:20px;
}

.card{
    padding:25px;
    border-radius:10px;
    color:white;
    box-shadow:0px 0px 10px rgba(0,0,0,0.2);
}

.card i{
    font-size:40px;
    margin-bottom:15px;
}

.card h2{
    font-size:35px;
}

.card p{
    margin-top:10px;
}

/* COLORES */

.card1{
    background:#4e73df;
}

.card2{
    background:#1cc88a;
}

.card3{
    background:#f6c23e;
}

.card4{
    background:#e74a3b;
}

/* TABLA */

.table-container{
    background:white;
    margin-top:30px;
    padding:20px;
    border-radius:10px;
    box-shadow:0px 0px 10px rgba(0,0,0,0.1);
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th{
    background:#001f4d;
    color:white;
    padding:15px;
}

table td{
    padding:12px;
    border:1px solid #ddd;
}

/* RESPONSIVE */

@media(max-width:768px){

.sidebar{
    width:100%;
    height:auto;
    position:relative;
}

.main{
    margin-left:0;
}

.cards{
    grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>OLIMPIADAS</h2>

<ul>

<li>
<a href="panel.php">
<i class="fa fa-home"></i>
 Dashboard
</a>
</li>

<li>
<a href="modules/usuarios/index.php">
<i class="fa fa-users"></i>
 Usuarios
</a>
</li>

<li>
<a href="modules/deportes/index.php">
<i class="fa fa-futbol"></i>
 Deportes
</a>
</li>

<li>
<a href="modules/equipos/index.php">
<i class="fa fa-trophy"></i>
 Equipos
</a>
</li>

<li>
<a href="modules/jugadores/index.php">
<i class="fa fa-user"></i>
 Jugadores
</a>
</li>

<li>

<a href="modules/programacion/index.php">

📅 Programación

</a>

</li>

<li>
<a href="modules/partidos/index.php">
<i class="fa fa-calendar"></i>
 Partidos
</a>
</li>


<li>
<a href="modules/resultados/index.php">
<i class="fa fa-chart-line"></i>
 Resultados
</a>
</li>

<li>


<li>
<a href="logout.php">
<i class="fa fa-sign-out"></i>
 Cerrar sesión
</a>
</li>

</ul>

</div>

<!-- MAIN -->

<div class="main">

<!-- TOPBAR -->

<div class="topbar">

<div>

<h1>
Bienvenido:
<?php echo $_SESSION['usuario']; ?>
</h1>

<?php

if($_SESSION['id_rol'] == 1){

echo "<h3>Administrador</h3>";

}else{

echo "<h3>Institución</h3>";

}

?>

</div>

<h3>
Sistema Web Olimpiadas PERU
</h3>

</div>

<!-- CARDS -->

<div class="cards">

<div class="card card1">

<i class="fa fa-users"></i>

<h2><?php echo $totalUsuarios; ?></h2>

<p>Usuarios</p>

</div>

<div class="card card2">

<i class="fa fa-trophy"></i>

<h2><?php echo $totalEquipos; ?></h2>

<p>Equipos</p>

</div>

<div class="card card3">

<i class="fa fa-futbol"></i>

<h2><?php echo $totalDeportes; ?></h2>

<p>Deportes</p>

</div>

<div class="card card4">

<i class="fa fa-calendar"></i>

<h2><?php echo $totalPartidos; ?></h2>

<p>Partidos</p>

</div>

</div>

<!-- TABLA -->

<div class="table-container">

<h2>Últimos Partidos</h2>

<table>

<tr>

<th>Local</th>
<th>Visitante</th>
<th>Fecha</th>
<th>Estado</th>

</tr>

<?php foreach($partidos as $partido){ ?>

<tr>

<td>
<?php echo $partido['equipo_local']; ?>
</td>

<td>
<?php echo $partido['equipo_visitante']; ?>
</td>

<td>
<?php echo $partido['fecha']; ?>
</td>

<td>
<?php echo $partido['estado']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>
