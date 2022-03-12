<!-- php for categ and posts -->
<?php
ob_start();
session_start();
include './init.php';
include './Frontend/includes/templates/header.php';
include './Frontend/includes/templates/navbar.php';
// every value of column must write inside '' 
$categ = $connect->prepare("SELECT * FROM categories WHERE status='visible'");
$categ->execute();
$row = $categ->rowCount();
$categdata = $categ->fetchAll();
?>


<style>
    <?php
    include './Frontend/assets/css/style.css';
    ?>
</style>


<header class="home">
    <!-- swiper start -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Frontend/uploads/image/carousel/hero-2.jpg" class="d-block w-100 pb-4" alt="...">
                <div class="carousel-text">
                    <h5 class="ms-2"> Fresh Flower & Gift shop </h5>
                    <h1>Making beautiful flowers a part of <br /> your life With Tulip shop <span style="color: #fb607f;"> ...</span></h1>
                    <a href=''> <button class=" btn btn-carousel">start now </button> </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Frontend/uploads/image/carousel/hero-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-text">
                    <h5 class="ms-2"> Fresh Flower & Gift shop </h5>
                    <h1>Making beautiful flowers a part of <br /> your life With Tulip shop <span style="color: #fb607f;"> ...</span></h1>
                    <a href=''> <button class="btn fw-bold btn-carousel">start now </button> </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- swiper end -->


<!-- start why tulip market -->
<section class="home-why">
    <div class="container">
        <h1 class="mt-5 mb-3"><span style="color: #fb607f;"> ...</span> why Tulip market </h1>
        <div class="row">
            <div class="col-lg-3 card ">
                <div class="card-title fw-bold"><img src="Frontend/uploads/image/why/1.webp" />
                    <span class="ms-3 fs-4">100% Freshness</span>
                </div>
                <div class="card-body ms-5  ">Most people are unaware of the less common flower</div>
            </div>

            <div class="col-lg-3 card">
                <div class="card-title"><img src="Frontend/uploads/image/why/2.webp" />
                    <span class="ms-3 fs-4 fw-bold"> Made by artist
                    </span>
                </div>
                <div class="card-body ms-5 ">Most people are unaware of the less common flower</div>
            </div>

            <div class="col-lg-3 card">
                <div class="card-title">
                    <img src="Frontend/uploads/image/why/3.webp" />
                    <span class="ms-3 fs-4 fw-bold"> Own courier </span>
                </div>
                <p class="card-body ms-5 ">Most people are unaware of the less common flower</p>
            </div>

            <div class="col-lg-3 card">
                <div class="card-title"><img src="Frontend/uploads/image/why/4.webp" />
                    <span class="ms-3 fs-4 fw-bold">Alot of Discounts</span>
                </div>
                <div class="card-body ms-5 ">Most people are unaware of the less common flower</div>
            </div>
        </div>
    </div>
</section>
<!-- end why tulip market -->





<!-- start categories -->


<section class="home-categ">
    <div class="container">
        <div class="row">
            <div class='d-flex '>
                <?php
                if ($row > 1) {
                    foreach ($categdata as $cat) {
                        echo "<div class='card col-lg-3 me-2 p-4 '>";
                        echo "<div class='card-img '>";
                        echo "<img src='" . $cat['image'] . "'  width='90%' />";
                        echo "</div>";
                        echo  "<h3 class=' mt-2  text-center '>" . $cat['title'] . "</h3>";
                        // echo  "<p class='card-text text-center mt-3 fw-bold'>" . $cat['description'] . "</p>";
                        // echo  "<p class='card-text text-center fw-bold'>";
                        // if (!empty($cat['id']===1)) {
                        //     $item=$categdata->rowCount();
                        //     echo "( items".$item.")";
                        // }
                        // echo "</p>";
                        echo "<a href='category-post.php?categId=" . $cat['id'] . "' class='text-decoration-none fw-bold text-light m-auto'>";
                        echo "<div class='btn btn-categ  '> posts here </div>";
                        echo "</a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!--end  categories -->





<!-- About us start -->

<section class="About">
    <div class="container">
        <div class="row">
            <div class="About-header col-lg-4 me-5">
                <h5 style="color:#fb607f">About us ...</h5>
                <h1>We provide all kinds of fresh flower services</h1>
            </div>
            <div class="About-text col-lg-7 ms-5 mt-3">
                <p>
                    For Heather Henson, of Boreal Blooms in Cold Lake, Alberta, Canada, growing flowers that can be dried and incorporated into late fall and winter floral arrangements has been a game-changer. During her growing season, this farmer-florist relies on a vivid palette of annuals, perennials and ornamental grasses to supply her studio.
                </p>
            </div>


        </div>
    </div>
</section>

<!--  -->
<section class="dry-flower mt-5">
    <div class="container">
        <div class="row">
            <div class="dry-flower-image col-lg-6  mt-5">
                <a href=""> <img src="Frontend/uploads/image/Abou-video/about-video.jpg" />
                    <i class="fa-regular fa-circle-play"></i>
                </a>
            </div>

            <div class="dry-flower-text col-lg-5   shadow p-4 pt-5 text-center">
                <h6 style="color: #fb607f;" class="fw-bold">SLOW FLOWERS’ FLORAL INSIGHTS</h3>
                    <h1>Dried flowers are having a renaissance</h1>
                    <p>
                        For Heather Henson, of Boreal Blooms in Cold Lake, Alberta, Canada, growing flowers that can
                        be dried and incorporated into late fall and winter floral arrangements has been a game-changer.
                        During her growing season, this farmer-florist relies on a vivid palette of annuals, perennials and ornamental grasses to supply her studio.
                    </p>
                    <div class="dry-flower-btn">contact us </div>

            </div>

        </div>
    </div><?php
            include './Frontend/includes/templates/footer.php';
            ?>
</section>