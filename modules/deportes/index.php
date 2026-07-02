<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php

include '../../config/database.php';

$sql = "SELECT * FROM deportes";

$stmt = $conexion->prepare($sql);

$stmt->execute();

$deportes = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Deportes | Olimpiadas PERU</title>

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

<i class="fa fa-futbol"></i>
 Olimpiadas PERU

</h1>

<h3>

Módulo Deportes

</h3>

</div>

<!-- CONTENIDO -->

<div class="container">

<!-- TOP -->

<div class="top">

<h2>

<i class="fa fa-trophy"></i>
 Gestión de Deportes

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
 Nuevo Deporte

</a>

</div>

</div>

<!-- TABLA -->

<table>

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Tipo</th>
<th>Acciones</th>

</tr>

<?php foreach($deportes as $deporte){ ?>

<tr>

<td>

<?php echo $deporte['id_deporte']; ?>

</td>

<td>

<?php echo $deporte['nombre']; ?>

</td>

<td>

<?php echo $deporte['tipo']; ?>

</td>

<td>

<a class="btn btn-warning"

href="editar.php?id=<?php echo $deporte['id_deporte']; ?>">

<i class="fa fa-edit"></i>
 Editar

</a>

<a class="btn btn-danger"

onclick="return confirm('¿Eliminar deporte?')"

href="eliminar.php?id=<?php echo $deporte['id_deporte']; ?>">

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
