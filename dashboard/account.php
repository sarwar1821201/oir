<?php
    include '../php/conn.php';

    session_start();
    $email = "";
    $name = "";
    $role = "";
    if(isset($_SESSION['user'])){
        $email = $_SESSION['user'];
        $name = $_SESSION['name'];
        $role = $_SESSION['role'];
    }else if (isset($_COOKIE['email'])){
        $email = $_COOKIE['email'];
        $name = $_COOKIE['name'];
        $role = $_COOKIE['role'];
    }else{
        header("Location: ../login.php");
    }

    // fetch user
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Account | Youth360</title>
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <?php
                if($role == 'admin'){
                    echo '<button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>';
                }
            ?>
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="#">Youth 365</a>
            
            <ul class="navbar-nav align-items-center ms-auto">
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="../images/user.png" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="../images/user.png" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?php echo $name; ?></div>
                                <div class="dropdown-user-details-email"><?php echo $email; ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="../php/auth/logout.php">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <?php 
                if($role == 'admin'){
                    echo '<div id="layoutSidenav_nav">
                    <nav class="sidenav shadow-right sidenav-light">
                        <div class="sidenav-menu">
                            <div class="nav accordion" id="accordionSidenav">
                                <a class="nav-link" href="index.php">
                                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                    Dashboards
                                </a>
                                <a class="nav-link" href="users.php">
                                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                                    Users
                                </a>
                                <a class="nav-link" href="messages.php">
                                    <div class="nav-link-icon"><i data-feather="send"></i></div>
                                    Messages
                                </a>
                                <a class="nav-link" href="companies.php">
                                    <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                                    Companies
                                </a>
                            </div>
                        </div>
                        <div class="sidenav-footer">
                            <div class="sidenav-footer-content">
                                <div class="sidenav-footer-subtitle">Logged in as:</div>
                                <div class="sidenav-footer-title">'.$name.'</div>
                            </div>
                        </div>
                    </nav>
                </div>';
                }
            ?>
            
            <?php 
                if($role=='admin'){
                    echo '<div id="layoutSidenav_content">';
                } else{
                    echo '<div id="layoutSidenav_content" style="padding-left: 0;">';
                }
            ?>
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Edit Profile
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <div class="col-xl-12">

                                <div class="alert-section">
                                    <?php
                                        if($user['update']){
                                            // alert to update
                                            echo '<div class="alert alert-info alert-dismissible fade show my-4" role="alert">
                                                    <div class="alert-body">
                                                        You have been requested to update your profile.
                                                    </div>
                                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        }
                                    ?>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form method="post" action="../php/auth/update.php">
                                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $user['firstName'] ?>" name="firstName"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $user['lastName'] ?>" name="lastName"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $user['email'] ?>" name="email"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPhone">Contact Number.</label>
                                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="<?php echo $user['contact'] ?>" name="contact"/>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy;Office of Industry Ralations-2022</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" ></script>
        <script>
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            if(params.success==1){
                $(".alert-section").append(`
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        Updated profile succeefully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }else if(params.success==0){
                $(".alert-section").append(`
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        Failed to upload profile.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }
        </script>
    </body>
</html>