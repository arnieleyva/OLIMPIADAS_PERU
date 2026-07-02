<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    return;
}

$id = (int) ($_POST['id'] ?? 0);

try {
    $stmt = $conexion->prepare('DELETE FROM deportes WHERE id_deporte = ?');
    $stmt->execute([$id]);
} catch (PDOException $e) {
}

header('Location: index.php');
return;
?>

<?php

include '../../config/database.php';

$id = $_GET['id'];

try{

    $sql = "DELETE FROM deportes
            WHERE id_deporte=?";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([$id]);

    header("Location:index.php");

}catch(PDOException $e){

    echo "

    <script>

    alert('No se puede eliminar este deporte porque tiene equipos asociados.');

    window.location='index.php';

    </script>

    ";

}
?>
