<?php
require __DIR__ . '/pages/login_handler.php';
return;
?>

<?php

session_start();
//
include 'config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email=?";

$stmt = $conexion->prepare($sql);

$stmt->execute([$email]);

$usuario = $stmt->fetch();

if($usuario){

    if(password_verify(
        $password,
        $usuario['password_hash']
    )){

        $_SESSION['usuario'] = $usuario['nombre'];

        $_SESSION['id_rol'] = $usuario['id_rol'];

        header("Location: panel.php");

    }else{

        echo "
        <script>
        alert('Contraseña incorrecta');
        window.location='index.php';
        </script>
        ";

    }

}else{

    echo "
    <script>
    alert('Usuario no encontrado');
    window.location='index.php';
    </script>
    ";

}

?>
