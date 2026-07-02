<?php
require __DIR__ . '/edit_view.php';
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios
WHERE id_usuario=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([$id]);

$usuario = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar Usuario</title>

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

width:500px;

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
position:relative;

}

.input-group input{

width:100%;

padding:14px 45px;

border:1px solid #ccc;

border-radius:10px;

font-size:15px;

}

.input-group i{

position:absolute;

left:15px;
top:16px;

color:#001f4d;

}

.input-group input:focus{

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

/* BOTONES CONTENEDOR */

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

<i class="fa fa-users"></i>
 Olimpiadas PERU

</h1>

<h3>

Editar Usuario

</h3>

</div>

<!-- FORMULARIO -->

<div class="container">

<h2>

<i class="fa fa-user-edit"></i>
 Actualizar Usuario

</h2>

<form action="actualizar.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $usuario['id_usuario']; ?>">

<div class="input-group">

<i class="fa fa-user"></i>

<input type="text"
name="nombre"

value="<?php echo $usuario['nombre']; ?>"

required>

</div>

<div class="input-group">

<i class="fa fa-user"></i>

<input type="text"
name="apellido"

value="<?php echo $usuario['apellido']; ?>"

required>

</div>

<div class="input-group">

<i class="fa fa-envelope"></i>

<input type="email"
name="email"

value="<?php echo $usuario['email']; ?>"

required>

</div>

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
