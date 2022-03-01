<?php
ob_start();
session_start();
include "./init.php";
if (isset($_SESSION['adminEmail'])) {
    include './Admin/includes/templates/navbar.php';

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

    <section class="DataUSer-show">
        <h2 class="bg-light text-center p-2">Admin Dashboard | Edit user data</h2>

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

                <input type="submit" class="btn btn-primary" value="update data" name="update"/>
            </form>
        </div>
    </section>

<?php

    include './Admin/includes/templates/footer.php';
} else {
    echo "<h3 clas='alert alert-danger text-center fs-5 fw-bold' style='text-align:center;color:red;margin-top:32px'>you can not brows this page directly <br>  during 5 seconds you will back to your road ... </h3>";
    header("Refresh:5,url=login.php");
    exit();
}




ob_end_flush();
// 
?>

<!-- <div class="container">
//             <div class="row">
// <div class="card border col-lg-4 text=center p-4 mt-5 mb-5">
//                     <div class="card-header p-2">

//                         <h4 class='text-center text-danger'>
//                             <?php
                                //                             echo " <span class='text-secondary'>" . $userdata['id'] . "</span>"; 
                                ?> _
//                             <?php
                                //                             echo  $userdata['user_name']  
                                ?>
//                         </h4>
//                     </div>                

//                     <div class="card-body">
//                         <h6>
//                             <?php
                                //                             echo " <h4 class='text-center'>" . $userdata['email'] . "</h4>";
                                //                             
                                ?>
//                         </h6>
//                     </div>
//                 </div>
//             </div>
//         </div>
//         </div> -->