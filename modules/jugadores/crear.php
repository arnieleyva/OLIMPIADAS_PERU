<?php
require __DIR__ . '/create_view.php';
return;
?>

<?php

include '../../config/database.php';

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

<title>Nuevo Jugador</title>

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

    width:500px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0px 0px 15px rgba(0,0,0,0.1);

}

.container h2{

    margin-bottom:25px;
    color:#001f4d;
    text-align:center;

}

/* INPUTS */

.input-group{

    margin-bottom:20px;

}

.input-group label{

    display:block;
    margin-bottom:8px;
    color:#333;
    font-weight:bold;

}

.input-group input,
.input-group select{

    width:100%;
    padding:14px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;

}

.input-group input:focus,
.input-group select:focus{

    border:1px solid #001f4d;
    outline:none;

}

/* BOTÓN */

button{

    width:100%;
    padding:15px;
    background:#001f4d;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;

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
    margin-top:50px;

}

/* RESPONSIVE */

@media(max-width:600px){

.container{

    width:90%;

}

.header{

    flex-direction:column;
    text-align:center;

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

<!-- FORMULARIO -->

<div class="container">

<h2>
<i class="fa fa-user"></i>
 Nuevo Jugador
</h2>

<form action="guardar.php" method="POST">

<div class="input-group">

<label>Nombre</label>

<input type="text"
name="nombre"
placeholder="Ingrese nombre"
required>

</div>

<div class="input-group">

<label>Apellido</label>

<input type="text"
name="apellido"
placeholder="Ingrese apellido"
required>

</div>

<div class="input-group">

<label>Número Camiseta</label>

<input type="number"
name="numero_camiseta"
placeholder="Ingrese número">

</div>

<div class="input-group">

<label>Equipo</label>

<select name="id_equipo">

<?php foreach($equipos as $equipo){ ?>

<option value="<?php echo $equipo['id_equipo']; ?>">

<?php echo $equipo['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<button type="submit">

<i class="fa fa-save"></i>
 Guardar Jugador

</button>

</form>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</body>
</html>
