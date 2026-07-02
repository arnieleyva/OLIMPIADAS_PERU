<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php

include '../../config/database.php';

$sql = "SELECT partidos.*,

local.nombre AS local_nombre,
visitante.nombre AS visitante_nombre

FROM partidos

INNER JOIN equipos local
ON partidos.equipo_local = local.id_equipo

INNER JOIN equipos visitante
ON partidos.equipo_visitante = visitante.id_equipo

ORDER BY partidos.id_partido DESC";

$stmt = $conexion->prepare($sql);

$stmt->execute();

$partidos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Partidos</title>

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

/* BOTONES */

.btn{

padding:10px 15px;
border:none;
border-radius:8px;
color:white;
text-decoration:none;
font-size:14px;
margin-right:5px;

}

.btn-primary{
background:#001f4d;
}

.btn-success{
background:#1cc88a;
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

/* FOOTER */

.footer{

background:#001f4d;
color:white;
text-align:center;
padding:15px;
margin-top:40px;

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

<!-- CONTENIDO -->

<div class="container">

<div class="top">

<h2>
<i class="fa fa-calendar"></i>
 Gestión de Partidos
</h2>

<div>

<a href="../../panel.php"
class="btn btn-primary">

Inicio

</a>

<a href="crear.php"
class="btn btn-success">

Nuevo Partido

</a>

</div>

</div>

<table>

<tr>

<th>ID</th>
<th>Local</th>
<th>Visitante</th>
<th>Fecha</th>
<th>Lugar</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

<?php foreach($partidos as $partido){ ?>

<tr>

<td>
<?php echo $partido['id_partido']; ?>
</td>

<td>
<?php echo $partido['local_nombre']; ?>
</td>

<td>
<?php echo $partido['visitante_nombre']; ?>
</td>

<td>
<?php echo $partido['fecha']; ?>
</td>

<td>
<?php echo $partido['lugar']; ?>
</td>

<td>
<?php echo $partido['estado']; ?>
</td>

<td>

<a href="editar.php?id=<?php echo $partido['id_partido']; ?>"
class="btn btn-primary">

Editar

</a>

<a href="eliminar.php?id=<?php echo $partido['id_partido']; ?>"
class="btn btn-danger"

onclick="return confirm('¿Eliminar partido?')">

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
