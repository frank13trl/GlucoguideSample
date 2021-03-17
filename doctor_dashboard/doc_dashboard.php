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
    Dashboard
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
  <style>
    #floating-button {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: #5e72e4;
      position: fixed;
      bottom: 30px;
      right: 30px;
      box-shadow: 0px 2px 5px #666;
    }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="#">
        <h1 class="text-blue">Glucoguide</h1>
        <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
      </a>

      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
          <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
      </form>
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item  active">
          <a class="nav-link  active" href="#">
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
      <!-- Divider -->
      <hr class="my-3">
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h1 mb-0 text-white text-capitalize d-none d-lg-inline-block" href="#">Dashboard</a>
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
      <?php
      echo "<h1 class='p-5'> Hello, Dr." . $_SESSION['user'] . "</h1>"; ?>

      <div class="row">
        <div class="col mb-3">
          <div class="row mb-4">
            <div class="col">
              <div class="card shadow">
                <div class="card-body">
                  <?php include 'info.php'; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow">
            <h1 class="card-header">Your Patients</h1>
            <div class="card-body" style="overflow-y:hidden;">
              <?php
              include('../config.php');
              if (mysqli_connect_error()) {
                echo "<span class='text-danger'>Unable to connect to database!</span>";
              } else {
                echo "<table class='table table-striped table-hover'>
                
                  <tr>
                    <th>Serial No.</th>
                    <th>Name of Patient</th>
                    <th>Patient ID</th>
                    <th>Report</th>
                  </tr>
                
                <tbody>";
                $count = 1;
                $patient = mysqli_query($handle, "SELECT * FROM patient_info i INNER JOIN casefile AS c ON i.userid = c.patient_id WHERE c.doctor_id='" . $_SESSION['userid'] . "';");
                if (mysqli_num_rows($patient) == 0) {
                  echo "<tr><td colspan = 5 align=center>No patients yet !</td></tr>";
                } else {
                  while ($plist = mysqli_fetch_array($patient)) {
                    $pid = $plist['userid'];
                    $pname = $plist['name'];
                    echo "<tr>
                    <td>"
                      . $count .
                      "</td>
                    <th>"
                      . $plist['name'] .
                      "</th>
                    <td>"
                      . $plist['userid'] .
                      "</td>
                    
                    <td>
                    <a href='patientinfo.php?patient=$pid&name=$pname'>" . "Detailed Report" . "</a>
                    </td>
                  </tr>";
                    $count++;
                  }
                }
                echo "</tbody></table>";
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <h4 class="card-header">New notifications</h4>
            <div class="card-body" style="height:500px; overflow-y:scroll;">

              <?php include 'display.php'; ?>
            </div>
          </div>
        </div>
      </div>


      <!-- Footer -->

      <a href="https://my.saleassist.ai/#/auth/login">
        <div id="floating-button">
          <i class="ni ni-chat-round text-white" style="margin-top: 19px; margin-left: 19px;"></i>
        </div>
      </a>
      <div class="row align-items-center justify-content-center">
        
          <div class="text-center text-muted p-5">
            Glucoguide Team
          </div>
        
      </div>
    </div>


  </div>
</body>

</html>