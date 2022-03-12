<!-- كل مجمعة الة مجموعة بوستات -->


<?php

ob_start();
session_start();
include './init.php';
include './Frontend/includes/templates/header.php';
include './Frontend/includes/templates/navbar.php';


if (isset($_GET['categId'])  && !empty($_GET['categId'])) {
    $categId = intval($_GET['categId']);
}


// check if exist or not depending on id
$categ = $connect->prepare("SELECT * FROM categories WHERE id=? ");
$categ->execute(array($categId));
$row = $categ->rowCount();


if ($row > 0) {
    $post = $connect->prepare("SELECT * FROM posts WHERE categ_id=? ");
    $post->execute(array($categId));
    $postdependingonCateg = $post->fetchAll();
}


?>
<style>
    <?php
    include './Frontend/assets/css/style.css';
    ?>
</style>



<section class="home-post-fromCateg">
    <div class="container">

        <h3 class='mt-5 mb-5 p-2 ' style='background: #fb607f'> <a href="home.php" class="text-decoration-none text-light ms-4">Home</a> </h1>
            <div class='d-flex mt-5 '>
                <?php
                if (!empty($postdependingonCateg)) {
                    foreach ($postdependingonCateg as $postss) {
                        echo "<div class='card col-lg-3 me-2  p-4 '>";
                        echo  "<h3 class='card-header text-center '>" . $postss['title'] . "</h3>";

                        echo "<div class='card-img mt-4'>";
                        echo "<img src='Admin/uploads/images/" . $postss['image'] . " ' width='90%' />";
                        echo "</div>";

                        echo  "<p class='card-text text-center mt-3 fw-bold'>" . $postss['body'] . "</p>";
                        echo "<div class='badge bg-  col-lg-6 m-auto'>";
                        echo "</div>";

                        echo "<div>" .
                            "<i class='fa-solid fa-plus'></i>" .
                            "</div>";
                        echo "</div>";
                    }
                }
                ?>

            </div>

    </div>
</section>











<?php
// include './Frontend/includes/templates/footer.php';
?>