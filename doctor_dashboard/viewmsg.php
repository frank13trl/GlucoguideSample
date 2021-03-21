<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login_page.php");
    exit();
}
?>
<!--

=========================================================
* Argon Dashboard - v1.1.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Messages
    </title>
    <!-- Favicon -->
    <link href="../assets/img/custom/icon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="#">
                <h1 class="text-blue">Glucoguide</h1>
                <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
            </a>

            <!-- Form -->
            <!-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form> -->
            <!-- Navigation -->
            <div class="col-sm-12">
            <ul class="navbar-nav">
                <li class="nav-item  active">
                    <a class="nav-link  active" href="doc_dashboard.php">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="doctor_settings.php">
                        <i class="ni ni-ui-04 text-red"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="userprofile.php">
                        <i class="ni ni-single-02 text-yellow"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">
                        <i class="ni ni-key-25 text-info"></i> Logout
                    </a>
                </li>
            </ul>
            </div>
            <!-- Divider -->
            <hr class="my-3">
        </div>
    </nav>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h1 mb-0 text-white text-capitalize d-none d-lg-inline-block" href="#">Previous messages</a>
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="../assets/img/custom/profile.jpg">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['user'] ?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>

        <!-- Dashboard info here-->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col mb-3">
                    <div class="card shadow">
                        <h1 class="card-header">Previous Messages from <?php echo $_GET['name'] ?></h1>
                        <div class="card-body" style="overflow-y:hidden;">
                            <?php
                            // create database connectivity

                            include ('../config.php');

                            // fetch data from student table..
                            $sql = "SELECT * FROM notification 
                                    where msg_to='" . $_SESSION['userid'] . "' and msg_from='".$_GET['patient']."'  order by sent_on desc";

                            $query = $handle->query($sql);
                            if ($query->num_rows  > 0) {
                                echo "<form method='POST' action='read.php'>
	                                    <table class='table table-hover table-striped'>
                                            <tr>
                                                <th>Message</th>
                                                <th>Sent on</th>
                                                <th>Action</th>
                                            </tr>
	                                        <tbody>";
                                while ($row = $query->fetch_assoc()) {
                                    $pid = $row['msg_from'];
                                    echo "<tr>
				                                <td style='white-space: pre-wrap;'>" . $row['message'] . "</td>
				                                <td style='white-space: pre-wrap;'>" . $row['sent_on'] . "</td>
				                                <td>";
                                    if ($row['msg_read'] == 0) {
                                        echo "<button class='btn btn-primary btn-sm' type='submit' name='mark' value=" . $row['id'] . ">
			                                    Mark as read</button>
			                                </td></tr>";
                                    }
                                }
                                echo "</tbody></table></form>";
                            } else {
                                echo "<div class='text-center'><i>No messages to show</i></div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->

            <div class="row align-items-center justify-content-center">

                <div class="text-center text-muted p-5">
                    Glucoguide Team
                </div>

            </div>

        </div>

    </div>
</body>

</html>