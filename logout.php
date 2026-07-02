<?php
require_once __DIR__ . '/includes/auth.php';
$_SESSION = [];
session_destroy();
header('Location: ' . app_url('index.php'));
return;
?>

<?php

session_start();

session_destroy();

header("Location:index.php");

?>
