<?php
require __DIR__ . '/app_header.php';
return;
?>

<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Olimpiadas PERU</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet"
href="../../css/style.css">

</head>
<body>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Olimpiadas PERÚ</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f4f6f9;
}

.header{

background:linear-gradient(
90deg,
#001f4d,
#0056b3
);

color:white;

padding:20px;

box-shadow:0 2px 10px rgba(0,0,0,.2);
}

.header h1{
font-size:28px;
}

.navbar{

background:white;

padding:15px;

box-shadow:0 2px 5px rgba(0,0,0,.1);

}

.navbar a{

text-decoration:none;

padding:10px 15px;

background:#0d6efd;

color:white;

border-radius:8px;

margin-right:10px;
}

.navbar a:hover{

background:#084298;

}

.container{

padding:20px;

}

.card{

background:white;

padding:20px;

border-radius:15px;

box-shadow:0 3px 10px rgba(0,0,0,.1);

}

table{

width:100%;

border-collapse:collapse;

margin-top:20px;

}

table th{

background:#0d6efd;

color:white;

padding:12px;

}

table td{

padding:10px;

border:1px solid #ddd;

}

.btn{

padding:8px 15px;

border-radius:8px;

text-decoration:none;

color:white;

}

.btn-success{
background:#198754;
}

.btn-warning{
background:#ffc107;
color:black;
}

.btn-danger{
background:#dc3545;
}

</style>

</head>

<body>

<div class="header">

<h1>
🏆 Sistema Web Olimpiadas PERÚ
</h1>

</div>

<div class="navbar">

<a href="../../panel.php">
🏠 Inicio
</a>

<a href="../../modules/resultados/index.php">
🏆 Resultados
</a>

<a href="../../modules/equipos/index.php">
👥 Equipos
</a>

<a href="../../logout.php">
🚪 Salir
</a>

</div>

<div class="container">
