<?php

ob_start();
session_start();
include "./init.php";
// if (isset($_SESSION['adminEmail'])) {
include './Admin/includes/templates/navbar.php';
$postid = $_GET['id'];
$SelsectpostandShow = $connect->prepare("SELECT * FROM posts WHERE id=? ");
$SelsectpostandShow->execute(array($postid));
$rownumber = $SelsectpostandShow->rowCount();

if ($rownumber > 0) {
    $postshow = $SelsectpostandShow->fetch();
}
?>
<form action="updatePost.php" method="post" class="shadow rounder p-4 mp-auto bg-light mt-5 mb-5 col-lg-6 m-auto">
    <div class="title">
        <h3 class=" bg-danger  bg-gradient text-light p-2 text-center">edit page post </h3>
    </div>

    <input type="hidden" value="<?php echo $postshow['id'] ?>" class="form-control" id="exampleInputPassword1" name="id">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Post title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='title-post' value="<?php echo $postshow['title']  ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">post body</label>
        <textarea type="text" class="form-control" id="exampleInputPassword1" name="body"><?php echo $postshow['body'] ?> </textarea>
    </div>
    <input type="submit" class="btn btn-primary" value=" send  post" name='post-btn' />

</form>

<?php
include './Admin/includes/templates/footer.php';
?>