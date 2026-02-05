<?php 
include '../elements/session_start.php';
unset($_SESSION['auth']);
header("Location: /login.php");
?>
 