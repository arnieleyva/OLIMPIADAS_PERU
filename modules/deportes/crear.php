
<?php
require __DIR__ . '/create_view.php';
return;
?>

<?php include '../../includes/header.php';
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Nuevo Deporte</title>
<link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="main">
<div class="form-container">

<h1>Nuevo Deporte</h1>

<form action="guardar.php" method="POST">

<input type="text" name="nombre" placeholder="Nombre" required>

<select name="tipo">
<option value="Varones">Varones</option>
<option value="Damas">Damas</option>
<option value="Mixto">Mixto</option>
</select>

<button class="btn" type="submit">Guardar</button>

</form>

</div>
</div>
<?php include '../../includes/footer.php';
 ?>



</body>
</html>
