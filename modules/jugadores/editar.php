<?php
require __DIR__ . '/edit_view.php';
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

$stmt = $conexion->prepare(
"SELECT * FROM jugadores
WHERE id_jugador=?"
);

$stmt->execute([$id]);

$jugador = $stmt->fetch();

$equipos = $conexion->query(
"SELECT * FROM equipos"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar Jugador</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.header{

background:#001f4d;
color:white;

padding:20px;

display:flex;
justify-content:space-between;

}

.container{

width:700px;

margin:30px auto;

background:white;

padding:30px;

border-radius:15px;

box-shadow:0 0 15px rgba(0,0,0,.1);

}

h2{

color:#001f4d;

text-align:center;

}

.form-group{

margin-bottom:15px;

}

label{

display:block;

margin-bottom:5px;

font-weight:bold;

}

input,select{

width:100%;

padding:12px;

border:1px solid #ccc;

border-radius:8px;

}

.btn{

padding:12px 18px;

border:none;

border-radius:8px;

color:white;

text-decoration:none;

cursor:pointer;

}

.btn-primary{

background:#001f4d;

}

.btn-success{

background:#1cc88a;

}

.footer{

background:#001f4d;

color:white;

padding:15px;

text-align:center;

margin-top:40px;

}

.buttons{

display:flex;

justify-content:space-between;

margin-top:20px;

}

</style>

</head>

<body>

<div class="header">

<h1>
<i class="fa fa-user"></i>
 Olimpiadas PERU
</h1>

<h3>
Editar Jugador
</h3>

</div>

<div class="container">

<h2>

Actualizar Jugador

</h2>

<form action="actualizar.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $jugador['id_jugador']; ?>">

<div class="form-group">

<label>Equipo</label>

<select name="id_equipo">

<?php foreach($equipos as $equipo){ ?>

<option
value="<?php echo $equipo['id_equipo']; ?>"

<?php
if(
$jugador['id_equipo']
==
$equipo['id_equipo']
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

<label>Nombres</label>

<input type="text"
name="nombres"
value="<?php echo $jugador['nombres']; ?>">

</div>

<div class="form-group">

<label>Apellidos</label>

<input type="text"
name="apellidos"
value="<?php echo $jugador['apellidos']; ?>">

</div>

<div class="form-group">

<label>DNI</label>

<input type="text"
name="dni"
value="<?php echo $jugador['dni']; ?>">

</div>

<div class="form-group">

<label>Edad</label>

<input type="number"
name="edad"
value="<?php echo $jugador['edad']; ?>">

</div>

<div class="form-group">

<label>Género</label>

<select name="genero">

<option value="Masculino">Masculino</option>

<option value="Femenino">Femenino</option>

</select>

</div>

<div class="form-group">

<label>Número Camiseta</label>

<input type="number"
name="numero_camiseta"
value="<?php echo $jugador['numero_camiseta']; ?>">

</div>

<div class="form-group">

<label>Posición</label>

<input type="text"
name="posicion"
value="<?php echo $jugador['posicion']; ?>">

</div>

<div class="buttons">

<a href="index.php"
class="btn btn-primary">

Volver

</a>

<button
type="submit"
class="btn btn-success">

Actualizar

</button>

</div>

</form>

</div>

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</body>
</html>
