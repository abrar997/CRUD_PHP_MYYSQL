<?php

ob_start();
session_start();
include './init.php';

if (isset($_SESSION['adminEmail'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['update'])) {
            $usrname = $_POST['username'];
            $email = $_POST['email'];
            $useridd = $_POST['id'];


            // before update we have to check is it exist or not 
            $statcheckbeforUpdate = $connect->prepare("SELECT * FROM users WHERE id=? ");
            $statcheckbeforUpdate->execute(array($useridd));
            $rows = $statcheckbeforUpdate->rowCount();

            // update
            if ($rows > 0) {
                $statUpdate = $connect->prepare("UPDATE users SET  `user_name`=?  ,  email=? WHERE id=? ");
                $statUpdate->execute(array($usrname, $email, $useridd));

                echo "<div class='alert alert-light text-center fs-5 fw-bold text-success '>User has been updated successfully</div>";
                header("Refresh:5,url=index.php");
                exit();
            } else {
                echo "error";
            }
        }
    }

    include './Admin/includes/templates/footer.php';
} else {
    echo "<h3 clas='alert alert-danger text-center fs-5 fw-bold' style='text-align:center;color:red;margin-top:32px'>you can not brows this page directly <br>  during 5 seconds you will back to your road ... </h3>";
    header("Refresh:5,url=index.php");
    exit();
}

ob_end_flush();
