<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php

include '../../config/database.php';

$sql = "SELECT * FROM usuarios";

$stmt = $conexion->prepare($sql);

$stmt->execute();

$usuarios = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Usuarios | Olimpiadas PERU</title>

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

width:95%;
margin:30px auto;

}

/* TOP */

.top{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:20px;

}

/* TITULO */

.top h2{

color:#001f4d;

}

/* BOTONES */

.btn{

padding:10px 15px;

border:none;
border-radius:8px;

color:white;

text-decoration:none;

font-size:14px;

margin-right:5px;

display:inline-block;

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

.btn-warning{
background:#f6c23e;
color:black;
}

.btn-danger{
background:#e74a3b;
}

/* TABLA */

table{

width:100%;

border-collapse:collapse;

background:white;

box-shadow:0px 0px 10px rgba(0,0,0,0.1);

border-radius:10px;

overflow:hidden;

}

table th{

background:#001f4d;
color:white;

padding:15px;

}

table td{

padding:12px;

border-bottom:1px solid #ddd;

}

table tr:hover{

background:#f1f1f1;

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

@media(max-width:768px){

.top{

flex-direction:column;
gap:15px;

}

table{

font-size:12px;

}

.btn{

display:block;
margin-bottom:5px;

}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

<h1>

<i class="fa fa-users"></i>
 Olimpiadas PERU

</h1>

<h3>

Módulo de Usuarios

</h3>

</div>

<!-- CONTENIDO -->

<div class="container">

<!-- TOP -->

<div class="top">

<h2>

<i class="fa fa-user"></i>
 Gestión de Usuarios

</h2>

<div>

<a href="../../panel.php"
class="btn btn-primary">

<i class="fa fa-home"></i>
 Inicio

</a>

<a href="crear.php"
class="btn btn-success">

<i class="fa fa-plus"></i>
 Nuevo Usuario

</a>

</div>

</div>

<!-- TABLA -->

<table>

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Email</th>
<th>Acciones</th>

</tr>

<?php foreach($usuarios as $usuario){ ?>

<tr>

<td>

<?php echo $usuario['id_usuario']; ?>

</td>

<td>

<?php echo $usuario['nombre']; ?>

</td>

<td>

<?php echo $usuario['email']; ?>

</td>

<td>

<a class="btn btn-warning"

href="editar.php?id=<?php echo $usuario['id_usuario']; ?>">

<i class="fa fa-edit"></i>
 Editar

</a>

<a class="btn btn-danger"

onclick="return confirm('¿Eliminar usuario?')"

href="eliminar.php?id=<?php echo $usuario['id_usuario']; ?>">

<i class="fa fa-trash"></i>
 Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</body>
</html>
