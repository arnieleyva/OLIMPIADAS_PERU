<?php
require __DIR__ . '/edit_view.php';
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

/* EQUIPO */

$sql = "SELECT * FROM equipos
WHERE id_equipo=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([$id]);

$equipo = $stmt->fetch();

/* INSTITUCIONES */

$instituciones = $conexion->query(
"SELECT * FROM instituciones"
)->fetchAll();

/* DEPORTES */

$deportes = $conexion->query(
"SELECT * FROM deportes"
)->fetchAll();

/* CATEGORIAS */

$categorias = $conexion->query(
"SELECT * FROM categorias"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar Equipo</title>

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

/* CONTENEDOR */

.container{

width:550px;

background:white;

margin:40px auto;

padding:35px;

border-radius:15px;

box-shadow:0px 0px 10px rgba(0,0,0,0.1);

}

/* TITULO */

.container h2{

text-align:center;

margin-bottom:25px;

color:#001f4d;

}

/* INPUTS */

.input-group{

margin-bottom:18px;

}

.input-group label{

display:block;

margin-bottom:8px;

font-weight:bold;

color:#001f4d;

}

.input-group input,
.input-group select{

width:100%;

padding:14px;

border:1px solid #ccc;

border-radius:10px;

font-size:15px;

}

.input-group input:focus,
.input-group select:focus{

outline:none;

border:1px solid #001f4d;

}

/* BOTONES */

.btn{

display:inline-block;

padding:12px 18px;

border:none;

border-radius:8px;

color:white;

text-decoration:none;

font-size:14px;

cursor:pointer;

transition:0.3s;

}

.btn:hover{

transform:scale(1.05);

}

.btn-primary{
background:#001f4d;
}

.btn-success{
background:#1cc88a;
}

/* CONTENEDOR BOTONES */

.buttons{

display:flex;

justify-content:space-between;

margin-top:20px;

}

/* FOOTER */

.footer{

background:#001f4d;

color:white;

text-align:center;

padding:15px;

margin-top:40px;

}

/* RESPONSIVE */

@media(max-width:600px){

.container{

width:90%;

}

.buttons{

flex-direction:column;
gap:10px;

}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

<h1>

<i class="fa fa-trophy"></i>
 Olimpiadas PERU

</h1>

<h3>

Editar Equipo

</h3>

</div>

<!-- FORMULARIO -->

<div class="container">

<h2>

<i class="fa fa-edit"></i>
 Actualizar Equipo

</h2>

<form action="actualizar.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $equipo['id_equipo']; ?>">

<!-- NOMBRE -->

<div class="input-group">

<label>

Nombre del Equipo

</label>

<input type="text"
name="nombre"

value="<?php echo $equipo['nombre']; ?>"

required>

</div>

<!-- INSTITUCION -->

<div class="input-group">

<label>

Institución

</label>

<select name="id_institucion">

<?php foreach($instituciones as $institucion){ ?>

<option
value="<?php echo $institucion['id_institucion']; ?>"

<?php
if($equipo['id_institucion']
== $institucion['id_institucion'])
echo "selected";
?>

>

<?php echo $institucion['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- DEPORTE -->

<div class="input-group">

<label>

Deporte

</label>

<select name="id_deporte">

<?php foreach($deportes as $deporte){ ?>

<option
value="<?php echo $deporte['id_deporte']; ?>"

<?php
if($equipo['id_deporte']
== $deporte['id_deporte'])
echo "selected";
?>

>

<?php echo $deporte['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- CATEGORIA -->

<div class="input-group">

<label>

Categoría

</label>

<select name="id_categoria">

<?php foreach($categorias as $categoria){ ?>

<option
value="<?php echo $categoria['id_categoria']; ?>"

<?php
if($equipo['id_categoria']
== $categoria['id_categoria'])
echo "selected";
?>

>

<?php echo $categoria['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- BOTONES -->

<div class="buttons">

<a href="index.php"
class="btn btn-primary">

<i class="fa fa-arrow-left"></i>
 Volver

</a>

<button type="submit"
class="btn btn-success">

<i class="fa fa-save"></i>
 Actualizar

</button>

</div>

</form>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</body>
</html>
