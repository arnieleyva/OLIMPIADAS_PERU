<?php require __DIR__ . '/edit_view.php'; return; ?>

<?php

include '../../config/database.php';
include '../../includes/header.php';

$id = $_GET['id'];

$sql = "SELECT * FROM resultados WHERE id_resultado=?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);

$resultado = $stmt->fetch();

?>

<div class="panel">

<h2>✏ Editar Resultado</h2>

<form action="actualizar.php" method="POST">

<input type="hidden"
name="id_resultado"
value="<?= $resultado['id_resultado']; ?>">

<label>Marcador Local</label>

<input type="number"
name="marcador_local"
value="<?= $resultado['marcador_local']; ?>"
required>

<label>Marcador Visitante</label>

<input type="number"
name="marcador_visitante"
value="<?= $resultado['marcador_visitante']; ?>"
required>

<label>Observaciones</label>

<input type="text"
name="observaciones"
value="<?= $resultado['observaciones']; ?>">

<br><br>

<button class="btn btn-success" type="submit">
💾 Actualizar
</button>

<a href="index.php" class="btn btn-primary">
⬅ Volver
</a>

</form>

</div>
<style>

.panel{
max-width:700px;
margin:30px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.1);
}

input{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ddd;
border-radius:8px;
}

.btn{
padding:10px 15px;
border:none;
border-radius:8px;
text-decoration:none;
color:white;
}

.btn-success{
background:#00b894;
}

.btn-primary{
background:#001f4d;
}

</style>

<?php include '../../includes/footer.php'; ?>
