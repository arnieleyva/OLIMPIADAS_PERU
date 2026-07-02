<?php
require_once __DIR__ . '/includes/auth.php';
require __DIR__ . '/pages/recover_view.php';
return;
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Recuperar Contraseña</title>

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

background-image:url('https://images.unsplash.com/photo-1547347298-4074fc3086f0');

background-size:cover;
background-position:center;
background-repeat:no-repeat;

min-height:100vh;

display:flex;
flex-direction:column;

}

/* CAPA OSCURA */

.overlay{

background:rgba(0,0,0,0.7);
min-height:100vh;

}

/* HEADER */

.header{

background:#001f4d;
padding:20px;
color:white;

display:flex;
justify-content:space-between;
align-items:center;

}

.header h1{

font-size:28px;

}

/* CONTENEDOR */

.container{

width:420px;

background:rgba(255,255,255,0.95);

margin:60px auto;

padding:35px;

border-radius:20px;

box-shadow:0px 0px 20px rgba(0,0,0,0.4);

backdrop-filter:blur(4px);

}

/* TITULO */

.container h2{

text-align:center;
margin-bottom:25px;
color:#001f4d;

}

.container p{

text-align:center;
margin-bottom:25px;
color:#555;
font-size:14px;

}

/* INPUTS */

.input-group{

margin-bottom:20px;
position:relative;

}

.input-group input{

width:100%;
padding:15px 45px;
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

button{

width:100%;
padding:15px;
background:#001f4d;
color:white;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
transition:0.3s;

}

button:hover{

background:#003380;

}

/* BOTON LOGIN */

.btn-login{

display:block;
text-align:center;

margin-top:15px;

background:#28a745;
color:white;

padding:14px;
border-radius:10px;

text-decoration:none;
font-weight:bold;

transition:0.3s;

}

.btn-login:hover{

background:#1e7e34;

}

/* FOOTER */

.footer{

margin-top:30px;
background:#001f4d;
color:white;
text-align:center;
padding:15px;

}

/* RESPONSIVE */

@media(max-width:500px){

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

<div class="overlay">

<!-- HEADER -->

<div class="header">

<h1>
<i class="fa fa-key"></i>
 Olimpiadas PERU
</h1>

<h3>
Recuperación de Cuenta
</h3>

</div>

<!-- FORM -->

<div class="container">

<h2>
<i class="fa fa-lock"></i>
 Recuperar Contraseña
</h2>

<p>

Ingrese su correo electrónico para recuperar su cuenta.

</p>

<form>

<div class="input-group">

<i class="fa fa-envelope"></i>

<input type="email"
placeholder="Ingrese su correo electrónico"
required>

</div>

<button type="submit">

<i class="fa fa-paper-plane"></i>
 Enviar Enlace

</button>

</form>

<a href="index.php"
class="btn-login">

<i class="fa fa-arrow-left"></i>
 Volver al Login

</a>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU | Sistema Web Deportivo

</div>

</div>

</body>
</html>
