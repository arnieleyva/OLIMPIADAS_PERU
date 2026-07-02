<?php
require __DIR__ . '/pages/index_view.php';//
return;
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login Olimpiadas PERU</title>

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

height:100vh;
display:flex;
justify-content:center;
align-items:center;

/* IMAGEN FONDO */

background-image:url('https://images.unsplash.com/photo-1547347298-4074fc3086f0');

background-size:cover;
background-position:center;
background-repeat:no-repeat;

position:relative;

}


/* OSCURECER FONDO */

body::before{

content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;

background:rgba(0,0,0,0.6);

z-index:0;

}

/* LOGIN ENCIMA */

.container{

position:relative;
z-index:1;

width:420px;
background:rgba(255,255,255,0.95);

padding:40px;
border-radius:20px;

backdrop-filter:blur(5px);

box-shadow:0px 0px 20px rgba(0,0,0,0.3);

}

/* CONTENEDOR */

.container{

width:420px;
background:white;
padding:40px;
border-radius:20px;
box-shadow:0px 0px 20px rgba(0,0,0,0.3);

}

/* LOGO */

.logo{

text-align:center;
margin-bottom:30px;

}

.logo i{

font-size:70px;
color:#005f4d;

}

.logo h1{

margin-top:10px;
color:#001f4d;

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
top:17px;
color:#001f4d;

}

.input-group input:focus{

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
border-radius:10px;
font-size:16px;
cursor:pointer;
transition:0.3s;

}

button:hover{

background:#003380;

}

/* LINKS */

.links{

margin-top:20px;
text-align:center;

}

.links a{

display:block;
margin-top:10px;
text-decoration:none;
color:#001f4d;
font-weight:bold;

}

.links a:hover{

color:#4b0082;

}

/* FOOTER */

.footer{

margin-top:25px;
text-align:center;
font-size:13px;
color:#777;

}

/* RESPONSIVE */

@media(max-width:500px){

.container{

width:90%;

}

}

</style>

</head>

<body>

<div class="container">

<!-- LOGO -->

<div class="logo">

<i class="fa fa-trophy"></i>

<h1>Olimpiadas PERU</h1>

</div>

<!-- LOGIN -->

<form action="login.php" method="POST">

<div class="input-group">

<i class="fa fa-envelope"></i>

<input type="email"
name="email"
placeholder="Correo electrónico"
required>

</div>

<div class="input-group">

<i class="fa fa-lock"></i>

<input type="password"
name="password"
placeholder="Contraseña"
required>

</div>

<button type="submit">

<i class="fa fa-sign-in"></i>
 Iniciar Sesión

</button>

</form>

<!-- LINKS -->

<div class="links">

<a href="registro.php">

<i class="fa fa-user-plus"></i>
 Crear cuenta

</a>

<a href="recuperar.php">

<i class="fa fa-key"></i>
 Recuperar contraseña

</a>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Olimpiadas PERU<br>
Sistema Web Deportivo

</div>

</div>

</body>
</html>
