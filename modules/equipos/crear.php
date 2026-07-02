<?php
require __DIR__ . '/create_view.php';
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

<title>Registrar Equipo | Olimpiadas PERU</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
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
box-shadow:0 2px 10px rgba(0,0,0,.2);
}

.header h1{
font-size:28px;
}

/* CONTENEDOR */

.container{
width:600px;
background:white;
margin:40px auto;
padding:30px;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.1);
}

.container h2{
color:#001f4d;
margin-bottom:25px;
text-align:center;
}

/* FORMULARIO */

label{
font-weight:bold;
display:block;
margin-bottom:5px;
}

input,select{
width:100%;
padding:12px;
margin-bottom:18px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;
}

input:focus,
select:focus{
outline:none;
border-color:#001f4d;
}

/* BOTONES */

.btn{
padding:12px 18px;
border:none;
border-radius:8px;
text-decoration:none;
cursor:pointer;
display:inline-block;
transition:.3s;
}

.btn-success{
background:#1cc88a;
color:white;
}

.btn-success:hover{
background:#17a673;
}

.btn-primary{
background:#001f4d;
color:white;
}

.btn-primary:hover{
background:#003380;
}

.botones{
display:flex;
gap:10px;
margin-top:10px;
}

/* FOOTER */

.footer{
background:#001f4d;
color:white;
text-align:center;
padding:15px;
margin-top:40px;
}

.footer p{
margin:0;
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

<div>
Sistema de Gestión Deportiva
</div>

</div>

<!-- FORMULARIO -->

<div class="container">

<h2>
<i class="fa fa-users"></i>
 Registrar Equipo
</h2>

<form action="guardar.php" method="POST">

<label>Nombre del Equipo</label>

<input type="text"
name="nombre"
placeholder="Ingrese nombre del equipo"
required>

<label>Deporte</label>

<select name="id_deporte" required>

<option value="">
Seleccione un deporte
</option>

<?php foreach($deportes as $deporte){ ?>

<option value="<?php echo $deporte['id_deporte']; ?>">

<?php echo $deporte['nombre']; ?>

</option>

<?php } ?>

</select>

<div class="botones">

<button class="btn btn-success"
type="submit">

<i class="fa fa-save"></i>
 Guardar Equipo

</button>

<a href="index.php"
class="btn btn-primary">

<i class="fa fa-arrow-left"></i>
 Volver

</a>

<a href="../../panel.php"
class="btn btn-primary">

<i class="fa fa-home"></i>
 Inicio

</a>

</div>

</form>

</div>

<!-- FOOTER -->

<div class="footer">

<p>
© 2026 Olimpiadas PERU | Sistema Web Deportivo
</p>

</div>

</body>
</html>
