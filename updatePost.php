<?php

ob_start();
session_start();
include './init.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['post-btn'])) {
        $title = $_POST['title-post'];
        $body = $_POST['body'];
        $useridd = $_POST['id'];


        // before update we have to check is it exist or not 
        $statcheckbeforUpdate = $connect->prepare("SELECT * FROM posts WHERE id=? ");
        $statcheckbeforUpdate->execute(array($useridd));
        $rows = $statcheckbeforUpdate->rowCount();

        // update
        if ($rows > 0) {
            $statUpdate = $connect->prepare("UPDATE posts SET  `title`=?  ,  body=? WHERE id=? ");
            $statUpdate->execute(array($title, $body, $useridd));

            echo "<div class='alert alert-light text-center fs-5 fw-bold text-success '>posts has been updated successfully</div>";
            header("Refresh:1,url=posts.php");
            exit();
        } else {
            echo "error";
        }
    }
}



ob_end_flush();

?>