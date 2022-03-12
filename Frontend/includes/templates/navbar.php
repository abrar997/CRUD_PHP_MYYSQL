<nav class="navbar navbar-expand-lg p-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <p class="navbar-brand tex-dark fs-4 mt-2 fw-bold mt-1" href="#">code/Mu. <img src='Frontend/uploads/image/img1.png' width='8%' /> </p>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </div>
            </button>

            <div class="collapse navbar-collapse col-lg-8 " id="navbarSupportedContent">
                <div class="col-lg-8">

                    <ul class="navbar-nav fs-4  ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">about</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#">shop</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#">services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#">contact</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 d-flex">
                    <i class="fa-solid mt-2 ms-5  fa-cart-plus"></i>
                    <i class="fa-regular mt-2 ms-2 fa-bell"></i>
                    <div class="dropdown ">
                        <a class="nav-link dropdown-toggle fw-bold text-dark dropdown-toggle" href="#" id=" avbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (isset($_SESSION['userEmail'])) {
                                echo $_SESSION['userEmail'];
                            } else {
                                echo "<i class='fa-solid fa-user-xmark  '></i>" .
                                    " no user";
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu bg-light border shadow" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">profile</a></li>
                            <li><a class="dropdown-item" href="#">setting</a></li>
                            <li><a class="dropdown-item" href="logout.php">logout</a></li>
                        </ul>

                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>