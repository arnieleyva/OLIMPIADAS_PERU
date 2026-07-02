<?php
require __DIR__ . '/index_view.php';
return;
?>

<?php

include '../../config/database.php';

$sql = "SELECT jugadores.*, equipos.nombre AS equipo

FROM jugadores

INNER JOIN equipos
ON jugadores.id_equipo = equipos.id_equipo";

$stmt = $conexion->prepare($sql);

$stmt->execute();

$jugadores = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Jugadores</title>

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

.header h1{
    font-size:28px;
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

    padding:12px 18px;
    border:none;
    border-radius:8px;
    color:white;
    text-decoration:none;
    font-size:14px;
    cursor:pointer;
    transition:0.3s;

}

.btn-primary{
    background:#001f4d;
}

.btn-primary:hover{
    background:#003380;
}

.btn-success{
    background:#1cc88a;
}

.btn-success:hover{
    background:#17a673;
}

.btn-danger{
    background:#e74a3b;
}

.btn-danger:hover{
    background:#c0392b;
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
Sistema Web Deportivo
</h3>

</div>

<!-- CONTENIDO -->

<div class="container">

<div class="top">

<h2>
<i class="fa fa-users"></i>
 Gestión de Jugadores
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
 Nuevo Jugador

</a>

</div>

</div>

<table>

<tr>

<th>ID</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Camiseta</th>
<th>Equipo</th>
<th>Acciones</th>

</tr>

<?php foreach($jugadores as $jugador){ ?>

<tr>

<td>
<?php echo $jugador['id_jugador']; ?>
</td>

<td>
<?php echo $jugador['nombres']; ?>
</td>

<td>
<?php echo $jugador['apellidos']; ?>
</td>

<td>
<?php echo $jugador['numero_camiseta']; ?>
</td>

<td>
<?php echo $jugador['equipo']; ?>
</td>

<td>

<a href="editar.php?id=<?php echo $jugador['id_jugador']; ?>"
class="btn btn-primary">

<i class="fa fa-edit"></i>

</a>

<a href="eliminar.php?id=<?php echo $jugador['id_jugador']; ?>"
class="btn btn-danger"

onclick="return confirm('¿Eliminar jugador?')">

<i class="fa fa-trash"></i>

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
