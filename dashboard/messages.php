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

    if($role != 'admin'){
        header("Location: account.php");
    }

    // fetch messages
    $sql = "SELECT * FROM messages";
    $result = $mysqli->query($sql);
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    $mysqli->close();


    // timestamp to date
    function formatDate($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Messages | OIR</title>
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">"OIR"</a>
            
            <ul class="navbar-nav align-items-center ms-auto">
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
                            <a class="nav-link" href="index.php">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Dashboards
                            </a>
                            <a class="nav-link" href="users.php">
                                <div class="nav-link-icon"><i data-feather="users"></i></div>
                                Users
                            </a>
                            <a class="nav-link" href="#">
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
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                <div class="alert-section"></div>
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                                            Messages
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">
                        <div class="card mb-4">
                            <!-- <div class="card-header">Extended DataTables</div> -->
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            foreach ($messages as $message) {
                                                echo "<tr>";
                                                echo "<td>" . $message['fullName'] . "</td>";
                                                echo "<td>" . $message['email'] . "</td>";
                                                echo "<td>" . formatDate($message['timestamp']) . "</td>";
                                                // print first 64 characters of message
                                                echo "<td>" . substr($message['message'], 0, 64) . "... 
                                                <button type='button' class='btn btn-light btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onClick='setupMessageId(".$message['id'].", \"".$message['fullName']."\");'>
                                                Read More
                                                </button>
                                                <p hidden id='msg".$message['id']."'>".$message['message']."</p>
                                                </td>";
                                                echo "<td><a href='../php/delete-message.php?id=" . $message['id'] . "' class='btn btn-danger'>Delete</a></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
            <!-- model for detail message -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="messageFrom"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a id="messageDeleteBtn" type="button" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" ></script>
        <script>
            function setupMessageId(id, name){
                // jqeury get inner html from id msg1
                var message = $("#msg"+id).html();
                document.getElementById("messageDeleteBtn").href = "../php/delete-message.php?id=" + id;
                document.getElementById("messageFrom").innerHTML = "Message from " + name;
                document.getElementById("exampleModal").querySelector(".modal-body").innerHTML = message;
            }

            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            if(params.success==1){
                $(".alert-section").append(`
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        Successfully performed action.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }else if(params.success==0){
                $(".alert-section").append(`
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        Failed to perform action.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }
        </script>
    </body>
</html>
