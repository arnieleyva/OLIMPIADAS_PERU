<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$id = (int) ($_POST['id'] ?? 0);

try {
    $stmt = $conexion->prepare('DELETE FROM equipos WHERE id_equipo = ?');
    $stmt->execute([$id]);
} catch (PDOException $e) {
}

header('Location: index.php');
return;
?>

```php
<?php

include '../../config/database.php';

$id=$_GET['id'];

try{

$stmt=$conexion->prepare(
"DELETE FROM equipos
WHERE id_equipo=?"
);

$stmt->execute([$id]);

header("Location:index.php");

}catch(PDOException $e){

echo "

<script>

alert('No se puede eliminar el equipo porque tiene jugadores asociados.');

window.location='index.php';

</script>

";

}
?>
```
