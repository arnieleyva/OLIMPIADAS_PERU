<?php
require __DIR__ . '/create_view.php';
return;
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Crear Usuario</title>

<link rel="stylesheet"
href="../../css/style.css">

</head>

<body>

<div class="main">

<div class="form-container">

<h1>Nuevo Usuario</h1>

<form action="guardar.php" method="POST">

<input type="text"
name="nombre"
placeholder="Nombre"
required>

<input type="text"
name="apellido"
placeholder="Apellido"
required>

<input type="email"
name="email"
placeholder="Correo"
required>

<input type="password"
name="password"
placeholder="Contraseña"
required>

<select name="id_rol">

<option value="1">
Administrador
</option>

<option value="2">
Institucion
</option>

</select>

<button class="btn" type="submit">
Guardar
</button>

</form>

</div>

</div>

</body>
</html>
