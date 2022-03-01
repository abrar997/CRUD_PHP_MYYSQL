<nav class="navbar navbar-expand-lg p-3">
    <div class="container">
        <a class="navbar-brand" href="#">code/Mu.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold fs-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id=" avbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if (isset($_SESSION['adminEmail'])) {
                            echo  $_SESSION['adminEmail'];
                        } else {
                            echo "there no user";
                            // header("Refresh:2,url=login.php");
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu text-dark fw-bold bg-light shadow border rounded " aria-labelledby="navbarDropdown">
                        <li><a class=" dropdown-item" href="#">settings</a>
                        </li>
                        <li><a class="dropdown-item" href="#">pofile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>