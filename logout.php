<?php 

session_start();

if(isset($_SESSION['adminEmail'])){
    session_unset($_SESSION['adminEmail']);
    session_destroy();
    header('Location:login.php');
    exit();
} else{
    session_unset($_SESSION['userEmail']);
    session_destroy();
    header('Location:login.php');
    exit();
}

?>