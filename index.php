<!-- CRUD ==> create ,Read,update,Delete -->

<?php

ob_start();
session_start();

include './init.php';
include './Admin/includes/templates/navbar.php';
// users
$usersquery = $connect->prepare("SELECT * FROM users ");
$usersquery->execute();
$allusers = $usersquery->fetchAll();
$numberusers = $usersquery->rowCount();

// posts
$Postsquery = $connect->prepare("SELECT * FROM posts ");
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
// ----------------------------------------------------------------------------------
?>


<section class="Admin-Index">
    <h1 class="bg-light p-1 ">Admin Dashboard</h1>
    <div class="container">
        <div class="row">

            <!-- Users -->
            <div class="col-lg-6 card border bg-light mt-3  mb-5 shadow p-3 mb-5 bg-body rounded me-2" style='margin-bottom:100px '>
                <?php if (!empty($usernotFound)) {
                    echo $usernotFound;
                } ?>
                <div class="card-header fw-bold fs-5 mb-5 ">Users <?php echo "<span class='badge bg-danger '> $numberusers </span>" ?> </div>
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

            <!-- ------------------------------------------------ -->

            <!-- Post -->
            <div class="col-lg-5 card border bg-light mt-3 shadow p-3 mb-5 bg-body rounded">
                <div class="card-header fw-bold fs-5 ">Post <?php echo "<span class='badge bg-danger '> $numberPosts </span>" ?> </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
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
                        if ($numberPosts > 0) {
                            foreach ($allPosts as $post) {
                                echo "<tr>";
                                echo "<td class='text-secondary'>" . $post['id'] . "</td>";
                                echo "<td scope='row'>" . $post['title'] . "</td>";
                                echo "<td>" . $post['body'] . "</td>";
                                echo "<td>" . $post['user_id'] . "</td>";
                                echo  "<td><a href=''> <i class='fa-solid fa-xmark me-4' title='delete post'></i> </a>
                            <a href=''><i class='fa-solid fa-pen-to-square' title='edit post'></i> </a>
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


<?php

include './Admin/includes/templates/footer.php';
ob_end_flush()


?>