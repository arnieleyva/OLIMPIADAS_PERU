<?php
require_once __DIR__ . '/includes/auth.php';
header('Location: ' . app_url('panel.php'));
return;
?>

<?php
session_start();//

if(!isset($_SESSION['usuario'])){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

<div class="sidebar">

<h2>OLIMPIADAS</h2>

<ul>

<li>
<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>
</li>

<li>
<a href="modules/usuarios/index.php">
<i class="fa fa-users"></i>
Usuarios
</a>
</li>

<li>
<a href="modules/deportes/index.php">
<i class="fa fa-futbol"></i>
Deportes
</a>
</li>

<li>
<a href="modules/equipos/index.php">
<i class="fa fa-trophy"></i>
Equipos
</a>
</li>

<li>
<a href="modules/jugadores/index.php">
<i class="fa fa-user"></i>
Jugadores
</a>
</li>


<li>

<a href="modules/programacion/index.php">

📅 Programación

</a>

</li>


<li>
<a href="modules/partidos/index.php">
<i class="fa fa-calendar"></i>
Partidos
</a>
</li>

<li>
<a href="modules/resultados/index.php">
<i class="fa fa-chart-line"></i>
 Resultados
</a>
</li>


<li>
<a href="logout.php">
<i class="fa fa-sign-out"></i>
Cerrar sesión
</a>
</li>

</ul>

</div>

<div class="main">

<h1>
Bienvenido:
<?php echo $_SESSION['usuario']; ?>
</h1>

<div class="card-container">

<div class="card">
<h2>20</h2>
<p>Equipos</p>
</div>

<div class="card">
<h2>100</h2>
<p>Jugadores</p>
</div>

<div class="card">
<h2>30</h2>
<p>Partidos</p>
</div>

<div class="card">
<h2>4</h2>
<p>Deportes</p>
</div>

</div>

</div>

</body>
</html>
