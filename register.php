 <?php
    ob_start();
    session_start();
    include './init.php';

    // Add new Account by insert sql 
    $errorpassword = "";
    $formsError = array();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['register']) {
            // filter 
            $usernamevali = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $emailvali = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $passwordvali = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $cpassword = filter_var($_POST['confpassword'], FILTER_SANITIZE_STRING);
            $hashpass = password_hash($passwordvali, PASSWORD_DEFAULT);



            // Validation :: || >><< 
            if (strlen($usernamevali) < 6) {
                $formsError[] = "username  must  greater than 6 ";
            }

            if (empty($passwordvali)) {
                $formsError[] = "password is required";
            }

            if (strlen($passwordvali) < 6) {
                $formsError[] = "password  must  greater than 6 ";
            }
            if ($_POST['password'] !== $_POST['confpassword']) {
                $formsError[] = "password not equal";
            }
            // ------------------------------


            if (empty($formsError)) {
                $staInsertAccount = $connect->prepare(" INSERT INTO users(`user_name`,email,`password`) VALUES (?,?,?)");
                $staInsertAccount->execute(array($usernamevali, $emailvali, $hashpass));
                // $staInsertAccount->execute(array(
                //     $usernamevali, $emailvali, $passwordvali
                // ));
                header("Refresh:0,url=login.php");
                exit();
                // }

            }





            // this Error means i have error in prepare ("syntax ")
            // Fatal error: Uncaught PDOException: SQLSTATE[21S01]: Insert value list does not match column list: 1136 Column count doesn't match value count at row 1 in E:\php\htdocs\phpmysql2\register.php:18 Stack trace: #0 E:\php\htdocs\phpmysql2\register.php(18): PDOStatement->execute(Array) #1 {main} thrown in E:\php\htdocs\phpmysql2\register.php on line 18
        }
    }


    ?>

 <section class="Register-Admin">

     <h2 class="p-2 text-center Login-Admin-h1 mt-5 text-light border border-dark" style="  background: rgb(165, 0, 77)">Register page</h2>
     <div class="container">
         <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="mt-5 fw-bold form p-4 w-50 m-auto mt-5 mb-5 border  shadow p-3 mb-5 bg-body rounded">
             <h2 class='text-center bg-primary text-light p-3 mt-3 text-capitalize'>create new account</h2>
             <div class="mb-3">
                 <label for="exampleInputEmail1" class="form-label mt-4">user name</label>
                 <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" placeholder="user name" required="true">
             </div>

             <div class="mb-3">
                 <label for="exampleInputEmail1" class="form-label">Email address</label>
                 <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email" required="true">
                 <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
             </div>

             <div class="mb-3">
                 <label for="exampleInputPassword1" class="form-label">Password</label>
                 <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="password" required="true">
             </div>

             <div class="mb-3">
                 <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                 <input type="password" class="form-control" id="exampleInputPassword1" name="confpassword" placeholder=" confirm your password" required>
             </div>

             <?php if (!empty($formsError)) {
                    foreach ($formsError as $err) {
                        echo "<div class='alert alert-danger'> $err</div>";
                    }
                }
                ?>

             <div class="mb-3 ">
                 <!-- <a href="" class="text-center t">login </a> -->
                 <input type="submit" name="register" class="btn btn-primary" value="Register" />
             </div>
         </form>
     </div>
 </section>


 <?php
    include './Admin/includes/templates/footer.php';
    ?>