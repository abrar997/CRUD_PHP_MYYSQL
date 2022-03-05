<?php
ob_start();
session_start();
include './init.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['post-btn'])) {

        $titleFromShow = $_POST['title-post'];
        $bodyFromShow = $_POST['body'];
        $idpost = $_POST['id'];


        $postdata = $connect->prepare("SELECT * FROM posts WHERE id=?");
        $postdata->execute(array($idpost));
        $rownumberpost = $postdata->rowCount();

        if ($rownumberpost > 0) {
            $updatepost = $connect->prepare("UPDATE posts SET title=? , body=? WHERE id=?");
            $updatepost->execute(array($titleFromShow, $bodyFromShow, $idpost));
            header("Location:posts.php");
            exit();
        } else {
            echo "error";
        }
    }
}

ob_end_flush();
