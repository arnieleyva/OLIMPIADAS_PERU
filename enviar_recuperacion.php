<?php
require __DIR__ . '/pages/recover_handler.php';
return;
?>

<?php

$email = $_POST['email'];

echo "

<h1>
Se envió un enlace de recuperación a:
$email
</h1>

";

?>
