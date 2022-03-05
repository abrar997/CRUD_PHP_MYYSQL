<?php
ob_start();
session_start();
include './init.php';

$error = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['post-btn']) {
        $titlePost = filter_var($_POST['title-post'], FILTER_SANITIZE_STRING);
        $bodyPost = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
        $userid = filter_var($_POST['data-option'], FILTER_VALIDATE_INT);



        // validation 
        if (strlen($titlePost) < 4) {
            $error[] = "title post must be greater than 4";
        }

        if (strlen($bodyPost) < 15) {
            $error[] = "your post must be graete than 15 chars";
        }

        if (!isset($_POST['data-option'])) {
            $error[] = "select user_id";
        }


        if (empty($error)) {
            $createPost = $connect->prepare("INSERT INTO `posts` ( `title`, `body`, `user_id`) VALUES ( ?, ?,? )");
            $createPost->execute(array($titlePost, $bodyPost, $userid));

            header("Refresh:0,url=posts.php");
            exit();
        }
    }
}

?>
<section class="create-post">
    <h3 class=" text-light text-center mt-5 p-2"> post page </h3>
    <div class="container">
        <div class="row">

            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="shadow rounder p-4 mp-auto bg-light mt-5 mb-5 col-lg-6 m-auto">

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
                        <option selected class='fs-5'>select....</option>
                        <?php $databse = $connect->prepare("SELECT * FROM users");
                        $databse->execute();
                        $datafetch = $databse->fetchAll();

                        foreach ($datafetch as $userid) {
                            echo " <option>" . $userid['id'] . "</option>";
                        }
                        ?>
                    </select>
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