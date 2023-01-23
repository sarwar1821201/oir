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
        header("Location: ../login.php");qa
    }

    if($role != 'admin'){
        header("Location: account.php");
    }

    $sql = "SELECT * FROM messages WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $result = $mysqli->query($sql);
    $messages = $result->num_rows;

    $sql = "SELECT * FROM users WHERE verified = 1";
    $result = $mysqli->query($sql);
    $verifiedUsers = $result->num_rows;

    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);
    $totalUsers = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard |OIR</title>
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="#">"OIR"</a>
            
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
                        <a class="dropdown-item" href="account.php">
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
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <a class="nav-link" href="#">
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
                            <div class="sidenav-footer-title"><?php echo $name; ?></div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-xl px-4 mt-5">
                        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                            <div class="me-4 mb-3 mb-sm-0">
                                <h1 class="mb-0">Dashboard</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-start-lg border-start-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-primary mb-1">Messages in Last 7 Days</div>
                                                <div class="h5"><?php echo $messages; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-envelope-open-text fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-start-lg border-start-secondary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-secondary mb-1">Approved User</div>
                                                <div class="h5"><?php echo $verifiedUsers; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-user-check fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-start-lg border-start-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">Total User</div>
                                                <div class="h5"><?php echo $totalUsers; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-users fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
    </body>
</html>
