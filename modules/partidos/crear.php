<?php
require __DIR__ . '/create_view.php';
return;
?>

<?php

include '../../config/database.php';

$equipos = $conexion->query(
"SELECT * FROM equipos"
)->fetchAll();

$eventos = $conexion->query(
"SELECT * FROM eventos"
)->fetchAll();

$deportes = $conexion->query(
"SELECT * FROM deportes"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Nuevo Partido</title>

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

/* HEADER */

.header{

background:#001f4d;
color:white;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;

}

/* FORM */

.container{

width:500px;
margin:40px auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0px 0px 10px rgba(0,0,0,0.1);

}

.container h2{

margin-bottom:20px;
color:#001f4d;

}

input,select{

width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:8px;

}

button{

background:#001f4d;
color:white;
padding:14px;
border:none;
width:100%;
border-radius:8px;
cursor:pointer;

}

button:hover{

background:#003380;

}

/* FOOTER */

.footer{

background:#001f4d;
color:white;
text-align:center;
padding:15px;
margin-top:30px;

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

<h1>
<i class="fa fa-futbol"></i>
 Olimpiadas PERU
</h1>

<h3>
Sistema Web Deportivo
</h3>

</div>

<!-- FORM -->

<div class="container">

<h2>
<i class="fa fa-calendar"></i>
 Nuevo Partido
</h2>

<form action="guardar.php" method="POST">

<label>Evento</label>

<select name="id_evento" required>

<?php foreach($eventos as $evento){ ?>

<option value="<?php echo $evento['id_evento']; ?>">

<?php echo $evento['nombre']; ?>

</option>

<?php } ?>

</select>

<label>Deporte</label>

<select name="id_deporte" required>

<?php foreach($deportes as $deporte){ ?>

<option value="<?php echo $deporte['id_deporte']; ?>">

<?php echo $deporte['nombre']; ?>

</option>

<?php } ?>

</select>

<label>Equipo Local</label>

<select name="equipo_local">

<?php foreach($equipos as $equipo){ ?>

<option value="<?php echo $equipo['id_equipo']; ?>">

<?php echo $equipo['nombre']; ?>

</option>

<?php } ?>

</select>

<label>Equipo Visitante</label>

<select name="equipo_visitante">

<?php foreach($equipos as $equipo){ ?>

<option value="<?php echo $equipo['id_equipo']; ?>">

<?php echo $equipo['nombre']; ?>

</option>

<?php } ?>

</select>

<input type="datetime-local"
name="fecha"
required>

<input type="text"
name="lugar"
placeholder="Lugar">

<button type="submit">

Guardar Partido

</button>

</form>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</body>
</html>
