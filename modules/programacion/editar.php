<?php

include '../../config/database.php';
include '../../includes/header.php';

$id = $_GET['id'];

$sql="

SELECT *

FROM partidos

WHERE id_partido=?

";

$stmt=$conexion->prepare($sql);
$stmt->execute([$id]);

$partido=$stmt->fetch();

?>

<div class="container">

<h2>✏ Editar Partido</h2>

<form action="actualizar.php" method="POST">

<input type="hidden"
name="id_partido"
value="<?= $partido['id_partido']; ?>">

<label>Fecha y Hora</label>

<input type="datetime-local"
name="fecha"
value="<?= date('Y-m-d\TH:i',strtotime($partido['fecha'])); ?>"
required>

<label>Lugar</label>

<input type="text"
name="lugar"
value="<?= $partido['lugar']; ?>"
required>

<label>Estado</label>

<select name="estado">

<option value="Pendiente">Pendiente</option>

<option value="Jugando">Jugando</option>

<option value="Finalizado">Finalizado</option>

</select>

<br><br>

<button class="btn btn-success">
💾 Actualizar
</button>

<a href="index.php"
class="btn btn-primary">

⬅ Volver

</a>

</form>

</div>

<?php include '../../includes/footer.php'; ?>