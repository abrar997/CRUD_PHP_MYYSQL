<?php
ob_start();
session_start();
include './init.php';

$error = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['post-btn']) {

        $titlePost = filter_var($_POST['title-post'], FILTER_SANITIZE_STRING);
        $bodyPost = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
        $userid = $_POST['data-option'];
       
        $categid = $_POST['categ-option'];
       
        $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

        // image //need name type size tmp-name 
        $imagename = $_FILES['postimage']['name'];
        $imagesize = $_FILES['postimage']['size'];
        $imagetmp = $_FILES['postimage']['tmp_name']; //المسار الم~قت على الجهاز
        $imageType = $_FILES['postimage']['type'];
        // if i want add pdf write this , 'pdf' inside array with exrtensions type 
        $allowedtypeExtensions = array('jpg', 'png', 'jpeg', 'gif', 'svg');
        $imgExtension1 = explode('.', $imagename);
        $imgExtension2 = strtolower(end($imgExtension1)); # تحويل نهاية المسار الى حروف صغيرة

        $imgbyaddrandomnumberbefornametosaveitindb = rand(0, 1000) . "_" . $imagename; #result->1233_img1.png
        //    from (temprary name in lap ) to (folder where i will save img)
        move_uploaded_file($imagetmp, "Admin/uploads/images/" . $imgbyaddrandomnumberbefornametosaveitindb);




        // validation 
        if (strlen($titlePost) < 4) {
            $error[] = "title post must be greater than 4";
        }

        if (strlen($bodyPost) < 15) {
            $error[] = "your post must be graete than 15 chars";
        }

        if (empty($error)) {
            $createPost = $connect->prepare("INSERT INTO `posts` ( `title`, `body`, `user_id`,`categ_id`,`status`,`image`) VALUES ( ?,?, ?,?,?,? )");
            $createPost->execute(array($titlePost, $bodyPost, $userid, $categid, $status, $imgbyaddrandomnumberbefornametosaveitindb));
            header("Refresh:0,url=posts.php");
            exit();
        }
    }
}

?>
<section class="create-post">
    <h3 class=" text-light text-center mt-5 p-2"> post page </h3>
    <div class="container">
        <div class="row  ">
            <!-- when deploy img or file u must add (enctype="multipart/form-data")   to form  -->
            <!-- # multipart/form-data: The value used for an <input> element with the type attribute set to "file". -->
            <form enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="shadow rounder p-4 mp-auto bg-light mt-5 mb-5 col-lg-6 m-auto">

                <div class="title">
                    <h3 class=" bg-gradient text-light p-2 text-center"> Create New Post</h3>
                </div>
                <?php if (!empty($error)) {
                    foreach ($error as $err) {
                        echo "<div class='alert alert-danger mt-2 '> $err
        </div>";
                    }
                } ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Post title</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='title-post' placeholder="title">
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Post body</label>
                    <textarea type="text" class="form-control" id="exampleInputPassword1" name="body"> </textarea>
                </div>



                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">select user id depending on id from user table </label><br />
                    <select name="data-option" class="data-select" required> start with
                        <?php $databse = $connect->prepare("SELECT * FROM users WHERE `type`='admin' ");
                        $databse->execute();
                        $datafetch = $databse->fetchAll();

                        foreach ($datafetch as $userid) {
                            echo " <option value=" . $userid['id'] . " " . $userid['user_name'] . ">" . $userid['id'] . "_ " . $userid['user_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">select categ_id </label><br />
                    <select name="categ-option" class="data-select" required> start with
                        <?php $databse = $connect->prepare("SELECT * FROM categories WHERE status='visible' ");
                        $databse->execute();
                        $datafetch = $databse->fetchAll();

                        foreach ($datafetch as $categ) {
                            echo " <option value=" . $categ['id'] . " " . $categ['title'] . ">" . $categ['id'] . "_ " . $categ['title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">status </label><br />
                    <select class="data-select" name="status">
                        <option value="hidden">hidden</option>
                        <option value="published">published</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">insert image</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='postimage'>
                </div>


                <input type="submit" class="btn btn-primary" value=" send  post" name='post-btn' />
            </form>
        </div>

    </div>


</section>

<?php
include './Admin/includes/templates/footer.php';
ob_end_flush();
?>