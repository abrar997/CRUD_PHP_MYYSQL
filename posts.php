<?php
ob_start();
session_start();
include './init.php';
if (isset($_SESSION['adminEmail'])) {
    include './Admin/includes/templates/navbar.php';

    $statpost = $connect->prepare("SELECT * FROM posts");
    $statpost->execute();
    $postsdata = $statpost->fetchAll();
    $numberercorsdpost = $statpost->rowCount();


    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "All";
    }

?>
    <!-- $page=All -->
    <?php if ($page == "All") { ?>
        <section class="post-Admin">
            <h1 class="bg-light text-center p-2 mt-4">Posts Managment</h1>
            <div class="container ">
                <div class="row">
                    <div class="create-new-post-btn"><a href="newPost.php"><button class="btn btn-primary p-2 fs-5 mt-3">create new post </button> </a></div>

                    <div class=" m-auto card border bg-light mt-3 shadow p-5 mb-5 bg-body rounded">
                        <div class="card-header fw-bold fs-5 mb-5">Post <?php echo "<span class='badge bg-danger '>$numberercorsdpost</span>" ?> </div>
                        <table class="table table-striped">
                            <thead>
                                <tr class="fs-5">
                                    <!-- <h6>Users </h6> -->
                                    <th scope="col">#</th>
                                    <th scope="col">title</th>
                                    <th scope="col">body</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($numberercorsdpost > 0) {
                                    foreach ($postsdata as $post) {
                                        echo "<tr>";
                                        echo "<td class='text-secondary'>" . $post['id'] . "</td>";
                                        echo "<td scope='row'>" . $post['title'] . "</td>";
                                        echo "<td>" . $post['body'] . "</td>";
                                        echo "<td>" . $post['user_id'] . "</td>";
                                        echo  "<td><a href='?page=deletepost&id=" . $post['id'] . "'> <i class='fa-solid fa-xmark me-4' title='delete post'></i> </a>
                            <a href='?page=showpost&id=" . $post['id'] . "'><i class='fa-solid fa-pen-to-square' title='edit post'></i> </a>
                                 </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<p class='alert alert-danger '>  there is no posts  </p>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php }
    if ($page == "showpost") {
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
    <?php }
    // Delete
    elseif ($page == "deletepost") {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $postid = intval($_GET['id']);
            $preparePost = $connect->prepare("SELECT * FROM posts WHERE id=?");
            $preparePost->execute(array($postid));
            $rownumber = $preparePost->rowCount();


            if ($rownumber > 0) {

                $deletePost = $connect->prepare("DELETE  FROM posts WHERE id=?");
                $deletePost->execute(array($postid));
                header("Location:posts.php");
                exit();
            } else {
                $usernotFound = " <p class='alert alert-danger'> user " . $postid . " not exist in database to delete</p>";
            }
        }
    }
    ?>


























<?php
}
include "./Admin/includes/templates/footer.php";
ob_end_flush()
?>