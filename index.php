<!-- CRUD ==> create ,Read,update,Delete -->

<?php

ob_start();
session_start();

include './init.php';

if (isset($_SESSION['adminID'])) {

    include './Admin/includes/templates/navbar.php';



    // users
    $usersquery = $connect->prepare("SELECT * FROM users ");
    $usersquery->execute();
    $allusers = $usersquery->fetchAll();
    $numberusers = $usersquery->rowCount();

    // posts 
    // $Postsquery = $connect->prepare("SELECT * FROM posts ");
    // if we have foreign key we use inner join to join two tables
    #posts.*,users.* to display every thing in users and post
    #,users.email or ant data i want to return it from other table
    $Postsquery = $connect->prepare("SELECT posts.*,users.user_name AS `name` FROM posts 
    INNER JOIN users ON posts.user_id = users.id ");
    $Postsquery->execute();
    $allPosts = $Postsquery->fetchAll();
    $numberPosts = $Postsquery->rowCount();



    // TO DELETE USER 
    // -------------------------------------------------------------------------
    // get user id to delete user
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $userid = intval($_GET['id']); #he scalar value being converted to an integer
        // check if user exist in database
        $stat = $connect->prepare("SELECT * FROM users WHERE id=? ");
        $stat->execute(array($userid));
        $row = $stat->rowCount();

        if ($row > 0) {
            // means user exist in data base
            // sql to delete when u click
            $statDelete = $connect->prepare("DELETE  FROM users WHERE id=? ");
            $statDelete->execute(array($userid));
            header("Location:index.php");
            exit();
            // echo "delete it";

        } else {
            $usernotFound = " <p class='alert alert-danger'> user " . $userid . " not exist in database to delete</p>";
        }
    }
} else {
    echo "<div class='alert alert-danger text-center'>sorry you cann't brwos this page   </div>";
    header("Refresh:2,url=login.php");
    exit();
}

// ----------------------------------------------------------------------------------

// To delete post

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





<section class="Admin-Index">
    <h1 class="bg-light p-1 ">Admin Dashboard</h1>
    <div class="" style="margin: auto;">
        <div class="row">

            <!-- Users -->
            <div class="col-lg-5 me-4 ms-5 card border bg-light mt-3  mb-5 shadow p-3 mb-5 bg-body rounded " style='margin-bottom:100px '>
                <?php if (!empty($usernotFound)) {
                    echo $usernotFound;
                } ?>
                <div class="card-header fw-bold fs-5 ">Users <?php echo "<span class='badge bg-danger '> $numberusers </span>" ?>
                    <a href="register.php">
                        <div class="btn btn-success text-light float-end"> new account</div>
                    </a>
                </div>
                <div class="card-body" id="style-13">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">user name</th>
                                <th scope="col">email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($numberusers > 0) {
                                foreach ($allusers as $users) {
                                    echo "<tr>";
                                    echo "<td class=' text-secondary'>" . $users['id'] . "</td>";
                                    echo "<td scope='row'>" . $users['user_name'] . "</td>";
                                    echo "<td>" . $users['email'] . "</td>";
                                    echo  "<td>
                                <a href='index.php?id=" . $users['id'] . "'  class=' me-4'> <i class='fa-solid fa-xmark' title='delete user'></i> </a>
                                <a href='showuser.php?id=" . $users['id'] . "'>  <i class='fa-solid fa-pen-to-square' title='edit user'></i> </a>
                                 </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo  "<p class='bg-danget text-center'>  there is no users  </p>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <!-- ------------------------------------------------ -->

            <!-- Post -->
            <div class="col-lg-6 card border bg-light mt-3 shadow p-3 mb-5 bg-body rounded post-card">
                <div class="card-header fw-bold fs-5 ">Post <?php echo "<span class='badge bg-danger '> $numberPosts </span>" ?>
                    <a href="newPost.php">
                        <div class="btn btn-success text-light float-end"> new post</div>
                    </a>
                </div>

                <div class=" card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <h6>Users </h6> -->
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">image</th>
                                <th scope="col">title</th>
                                <th scope="col">body</th>
                                <th scope="col">name of user</th>
                                <th scope="col">status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($numberPosts > 0) {
                                foreach ($allPosts as $post) {
                                    echo "<tr>";
                                    // echo "<td class='text-secondary'>" . $post['id'] . "</td>";
                                    echo "<td class='text-secondary'>";
                                    echo "<img src='Admin/uploads/images/" . $post['image'] . "' class='img-post' width='25%' height='15%'/>";
                                    echo "</td>";
                                    echo "<td scope='row'>" . $post['title'] . "</td>";
                                    echo "<td class='td'>" . $post['body'] . "</td>";
                                    echo "<td>" . $post['name'] . "</td>";
                                    if ($post['status'] == "hidden") {
                                        echo "<td><span class='badge bg-danger p-2'>  " . $post['status'] . "</span></td>";
                                    } else {

                                        echo
                                        "<td ><span class='badge bg-success p-2'> " . $post['status'] . "</span></td>";
                                    }
                                    echo  "<td><a href='index.php?id=" . $post['id'] . "'> <i class='fa-solid fa-xmark me-2' title='delete post'></i> </a>
                            <a href='showpost.php?id=" . $post['id'] . "'><i class='fa-solid fa-pen-to-square' title='edit post'></i> </a>
    
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
    </div>
</section>


<?php

include './Admin/includes/templates/footer.php';
ob_end_flush()


?>