<?php
require __DIR__ . '/edit_view.php';
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

$stmt = $conexion->prepare("
SELECT * FROM partidos
WHERE id_partido=?
");

$stmt->execute([$id]);

$partido = $stmt->fetch();

$eventos = $conexion->query(
"SELECT * FROM eventos"
)->fetchAll();

$deportes = $conexion->query(
"SELECT * FROM deportes"
)->fetchAll();

$equipos = $conexion->query(
"SELECT * FROM equipos"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Partido</title>

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
background:#f4f6f9;
}

.header{
background:#001f4d;
color:white;
padding:20px;
text-align:center;
}

.container{
width:850px;
max-width:95%;
margin:30px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.15);
}

h2{
text-align:center;
margin-bottom:25px;
color:#001f4d;
}

.form-group{
margin-bottom:15px;
}

label{
display:block;
margin-bottom:5px;
font-weight:bold;
color:#001f4d;
}

input,
select{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
}

.buttons{
display:flex;
justify-content:space-between;
margin-top:20px;
}

.btn{
padding:12px 20px;
border:none;
border-radius:8px;
text-decoration:none;
color:white;
font-weight:bold;
cursor:pointer;
}

.btn-primary{
background:#001f4d;
}

.btn-success{
background:#1cc88a;
}

.footer{
margin-top:40px;
background:#001f4d;
color:white;
text-align:center;
padding:15px;
}

</style>

</head>

<body>

<div class="header">

<h1>
<i class="fa fa-calendar"></i>
 Olimpiadas PERU
</h1>

</div>

<div class="container">

<h2>
<i class="fa fa-edit"></i>
 Editar Partido
</h2>

<form action="actualizar.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $partido['id_partido']; ?>">

<div class="form-group">

<label>Evento</label>

<select name="id_evento">

<?php foreach($eventos as $evento){ ?>

<option
value="<?php echo $evento['id_evento']; ?>"

<?php
if(
$evento['id_evento']
==
$partido['id_evento']
)
echo "selected";
?>

>

<?php echo $evento['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Deporte</label>

<select name="id_deporte">

<?php foreach($deportes as $deporte){ ?>

<option
value="<?php echo $deporte['id_deporte']; ?>"

<?php
if(
$deporte['id_deporte']
==
$partido['id_deporte']
)
echo "selected";
?>

>

<?php echo $deporte['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Equipo Local</label>

<select name="equipo_local">

<?php foreach($equipos as $equipo){ ?>

<option
value="<?php echo $equipo['id_equipo']; ?>"

<?php
if(
$equipo['id_equipo']
==
$partido['equipo_local']
)
echo "selected";
?>

>

<?php echo $equipo['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Equipo Visitante</label>

<select name="equipo_visitante">

<?php foreach($equipos as $equipo){ ?>

<option
value="<?php echo $equipo['id_equipo']; ?>"

<?php
if(
$equipo['id_equipo']
==
$partido['equipo_visitante']
)
echo "selected";
?>

>

<?php echo $equipo['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Fecha</label>

<input
type="datetime-local"
name="fecha"
value="<?php echo date('Y-m-d\TH:i',strtotime($partido['fecha'])); ?>">
</div>

<div class="form-group">

<label>Lugar</label>

<input
type="text"
name="lugar"
value="<?php echo $partido['lugar']; ?>">

</div>

<div class="form-group">

<label>Estado</label>

<select name="estado">

<option value="Pendiente">Pendiente</option>
<option value="En Juego">En Juego</option>
<option value="Finalizado">Finalizado</option>

</select>

</div>

<div class="buttons">

<a href="index.php"
class="btn btn-primary">

<i class="fa fa-arrow-left"></i>
 Volver

</a>

<button
type="submit"
class="btn btn-success">

<i class="fa fa-save"></i>
 Actualizar

</button>

</div>

</form>

</div>

<div class="footer">

© 2026 Olimpiadas PERU |
Sistema Web Deportivo

</div>

</body>
</html>
