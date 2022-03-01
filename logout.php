<?php 

session_start();
session_unset($_SESSION['adminEmail']);
session_destroy();
header('Location:login.php');
exit()

?>