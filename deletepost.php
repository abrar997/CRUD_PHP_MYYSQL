<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $postid = intval($_GET['id']);
    
    
    $preparePost = $connect->prepare("SELECT * FROM posts WHERE id=? ");
    $preparePost->execute(array($postid));
    $rownumber = $preparePost->rowCount();


    if ($rownumber > 0) {
        $deletePost = $connect->prepare("DELETE  FROM posts WHERE id=?");
        $deletePost->execute(array($postid));
        header("Location:index.php");
        exit();
    } else {
        $usernotFound = " <p class='alert alert-danger'> user " . $postid . " not exist in database to delete</p>";
    }
}
?>