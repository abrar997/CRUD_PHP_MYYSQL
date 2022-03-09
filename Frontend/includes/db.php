<!-- database file -->

<?php
$dbname = "mysql:host=localhost;dbname=xteam";
$username = "root";
$pass = "";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

try {
    $connect = new PDO($dbname, $username, $pass, $option);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "error: erver failed to connect with database" . $e->getMessage();
}



?>