<?php
require __DIR__ . '/create_view.php';
return;
?>

<?php

include '../../config/database.php';
include '../../config/database.php';
include '../../includes/header.php';

$partidos = $conexion->query("
SELECT p.id_partido,
e1.nombre AS local,
e2.nombre AS visitante

FROM partidos p

INNER JOIN equipos e1
ON p.equipo_local=e1.id_equipo

INNER JOIN equipos e2
ON p.equipo_visitante=e2.id_equipo

")->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Registrar Resultado</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{

width:700px;
margin:auto;

background:white;

padding:30px;

margin-top:30px;

border-radius:15px;

box-shadow:0 0 15px rgba(0,0,0,.1);

}

input,select{

width:100%;
padding:12px;
margin-bottom:15px;

}

.btn{

background:#001f4d;
color:white;

padding:12px;

border:none;

cursor:pointer;

}

</style>

</head>

<body>

<div class="container">

<h2>Registrar Resultado</h2>

<form action="guardar.php" method="POST">

<label>Partido</label>

<select name="id_partido">

<?php foreach($partidos as $p){ ?>

<option value="<?php echo $p['id_partido']; ?>">

<?php

echo $p['local'];

echo " VS ";

echo $p['visitante'];

?>

</option>

<?php } ?>

</select>

<label>Marcador Local</label>

<input type="number"
name="marcador_local"
required>

<label>Marcador Visitante</label>

<input type="number"
name="marcador_visitante"
required>

<label>Observaciones</label>

<input type="text"
name="observaciones">

<button
class="btn"
type="submit">

Guardar Resultado

</button>

</form>

</div>
<?php include '../../includes/footer.php'; ?>

</body>

</html>
