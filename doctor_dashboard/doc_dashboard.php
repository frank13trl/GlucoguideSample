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
  <meta charset="UTF-8" />
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
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/filter/dist/excel-bootstrap-table-filter-style.css">
  <!-- Scripts -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/filter/dist/excel-bootstrap-table-filter-bundle.js"></script>

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
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.html">
        <h1 class="display-3 text-blue">Glucoguide</h1>
      </a>
      <!-- Navigation -->
      <div class="col-sm-12">
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
      </div>
      <!-- Divider -->
      <hr class="my-3">
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid mt-4">
        <!-- Brand -->
        <div class="display-3 text-white text-capitalize d-none d-lg-inline-block">
          <?php echo "Hello, Dr." . $_SESSION['user']; ?>
        </div>
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
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="userprofile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="doctor_settings.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
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
    <div class="container-fluid mt--5">
      <div class="row">
        <div class="col mb-3">
          <div class="row mb-3">
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
            <div class="card-body" style="overflow-x:scroll; min-height:550px">
              <?php
              include('../config.php');
              if (mysqli_connect_error()) {
                echo "<span class='text-danger'>Unable to connect to database!</span>";
              } else {
                echo "<table class='table table-striped table-hover' id='table'><thead>
                  <tr>
                    <th>Serial No.</th>
                    <th>Name of Patient</th>
                    <th>Patient ID</th>
                    <td>Report</td>
                  </tr>
                </thead>
                <tbody>";
                $id = $_SESSION['userid'];
                $count = 1;
                $patient = mysqli_query($handle, "SELECT * FROM patient_info i INNER JOIN casefile AS c ON i.userid = c.patient_id 
                                                  WHERE c.doctor_id='$id';");

                if (mysqli_num_rows($patient) == 0) {
                  echo "<tr><td colspan = 5 align=center>No patients yet !</td></tr>";
                } else {
                  while ($plist = mysqli_fetch_array($patient)) {

                    $pid = $plist['userid'];
                    $pname = $plist['name'];
                    echo "<tr>
                      <td>" . $count . "</td>
                      <td>" . $plist['name'] . "</td>
                      <td>" . $plist['userid'] . "</td>
                      <td><a href='patientinfo.php?patient=$pid&name=$pname'>Detailed Report</a></td>
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
            <div class="card-body" style="height:700px; overflow-y:scroll;">
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
      <div class="row justify-content-center">
        <div class="text-center text-muted p-5">
          Glucoguide Team
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#table').excelTableFilter();
  </script>
</body>

</html>