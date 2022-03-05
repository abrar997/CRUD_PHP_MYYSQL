<!-- index.php -->
<?php

ob_start();
session_start([]);
include "./init.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // declare variable and connect with database 
    $tryUser = $connect->prepare("SELECT * FROM users WHERE email=? AND `password`=?  "); #search email in database
    $tryUser->execute(array($email, $password));
    $numberUSer = $tryUser->rowCount();

    // check if user login to database this condition work with session ;;
    if ($numberUSer > 0) {
        $adminUser = $tryUser->fetch(); #to get single row
        // $hashpassword = $adminUser['password'];
        // if (password_verify($password, $hashpassword)) {

        // u  couldn't use other name
        $_SESSION['adminID'] = $adminUser['id'];
        $_SESSION['adminEmail'] = $adminUser['email'];
        // }
    } else {

        $error = "<p class='text-danger'>
        there is no user like <span class=' border-bottom border-dark pb-1'>( $email ) </span>,please try again </p>";
    }
}

if (isset($_SESSION['adminID'])) {
    header("Refresh:0,url=index.php");
    exit();
}
?>

<!-- Login  -->
<section class="Login-Admin mt-5">
    <h2 class="p-2 text-center text-light Login-Admin-h1" style=" background:rgb(165, 0, 77)">Login page</h2>
    <div class="container ">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class=" m-auto w-50 mt-5 border p-4 fw-bold  shadow p-3 mb-5 bg-body rounded ">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="password">
            </div>
            <?php if (!empty($error)) {
                echo $error;
            } ?>

            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <a href="Register.php">create new account </a>
        </form>
    </div>
</section>
<?php

include "./Admin/includes/templates/footer.php";
ob_end_flush();

?>