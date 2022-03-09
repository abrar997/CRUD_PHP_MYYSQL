<!-- اذا استخدمنة post لازم عندي فورم اخذ منو الادتا  -->
<!-- اذا استخدمنة get اعتمد على url  -->

<?php

ob_start();
session_start();

include './init.php';


if (isset($_SESSION['adminEmail'])) {
    include './Admin/includes/templates/navbar.php';
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "All";
    }

    // All
    // to fetch all data users
    $usersquery = $connect->prepare("SELECT * FROM users ");
    $usersquery->execute();
    $allusers = $usersquery->fetchAll();
    $numberusers = $usersquery->rowCount();

    // ----------------------------------------------------------------------------------
?>
    <h1 class="bg-light p-1 text-center ">User Managment</h1>
    <!-- -------------------------start All---------------- -->
    <?php if ($page == "All") { ?>

        <!-- html All -->
        <section class="Admin-Index-user ALL">
            <div class="container">

                <div class="row">
                    <div class="btn-new-acount p-2 mt-3 mr-auto"><a href="register.php"><button class="btn fs-5 btn-primary"> Create new account</button> </a></div>
                    <!-- Users -->
                    <div class="col-lg-12 card border bg-light mt-3  mb-5 shadow p-3 mb-5 bg-body rounded me-2" style='margin-bottom:100px '>
                        <?php if (!empty($usernotFound)) {
                            echo $usernotFound;
                        } ?>
                        <div class="card-header fw-bold fs-5 mb-5 ">Users <?php echo "<span class='badge bg-danger '> $numberusers </span>" ?> </div>
                        <table class="table table-striped">
                            <thead>
                                <tr class="fs-5">
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
                                        echo "<td class=' text-secondary fw-bold '>" . $users['id'] . "</td>";
                                        echo "<td scope='row'>" . $users['user_name'] . "</td>";
                                        echo "<td>" . $users['email'] . "</td>";
                                        echo  "<td>
                                <a href='?page=deleteUser&id=" . $users['id'] . "' class=' me-4'> <i class='fa-solid fa-xmark' title='delete user'></i> </a>
                                <a href='?page=editUer&id=" . $users['id'] . "'>  <i class='fa-solid fa-pen-to-square' title='edit user'></i> </a>
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
            </div>
        </section>
        <!-- -------------------------end All---------------- -->



        <!-- -------------------------start editUer---------------- -->
    <?php } elseif ($page == "editUer") {
        // Query to fetch all data of one user  who login by click on edit button in index.php 
        // get data if user by id ;


        $userId = $_GET['id'];
        $statm = $connect->prepare("SELECT * FROM users WHERE id=? ");
        $statm->execute(array($userId));
        $rows = $statm->rowCount();


        if ($rows > 0) {
            $userdata = $statm->fetch();
        }

    ?>
        <section class="DataUSer-show Edituser ">
            <div class="container">
                <form class="form  w-50 m-auto mt-5 mb-5 border  shadow p-3 mb-5 bg-body rounded" action="updateUser.php" method="post">

                    <input type="hidden" value="<?php echo $userdata['id'] ?>" class="form-control" id="exampleInputPassword1" name="id">
                    <h3 class="text-center bg-primary text-light p-2">update data </h3>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">user name</label>
                        <input type="text" value="<?php echo $userdata['user_name'] ?>" class="form-control" id="exampleInputPassword1" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" value="<?php echo $userdata['email'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>

                    <input type="submit" class="btn btn-primary" value="update data" name="update" />
                </form>
            </div>
        </section>
        <!-- -------------------------end editUser---------------- -->



        <!-- // -------------------------start delete---------------- -->
    <?php
    } elseif ($page == "deleteUser") {
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
                header("Location:user.php");
                exit();
                // echo "delete it";

            } else {
                $usernotFound = " <p class='alert alert-danger'> user " . $userid . " not exist in database to delete</p>";
            }
        }
    } ?>



<?php
}
include './Admin/includes/templates/footer.php';
ob_end_flush(); ?>