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
    Administrator
  </title>
  <!-- Favicon -->
  <link href="../assets/img/custom/icon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <!-- Scripts -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.html">
        <div class="display-3 text-blue">Glucoguide</div>
      </a>
      <!-- Navigation -->
      <div class="col-sm-12">
        <ul class="navbar-nav">
          <li class="nav-item  active ">
            <a class="nav-link  active " href="#">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
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
        <div class="display-3 text-white text-capitalize d-none d-lg-inline-block">Administrator Dashboard</div>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/custom/profile.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Administrator</h6>
              </div>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i><span>Logout</span>
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
          <div class="card shadow">
            <h1 class="card-header">User statistics</h1>
            <div class="card-body">

              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group" id="userid" style="display: inline-block;">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                    </div>
                    <select class="form-control" name="userid">
                      <option disabled selected>Select user</option>
                      <?php require('user_option.php'); ?>
                    </select>
                  </div>
                </div>
                <div class="text-center" style="display: inline-block; margin-left: 30px;">
                  <button type="submit" name="get_inf" class="btn btn-primary">Get Details</button>
                </div>
              </form>

              <hr>

              <div class="row" style="min-height: 300px;">
                <div class="col">
                  <div class="row">
                    <?php require('info.php'); ?>
                  </div>
                  <div class="row-12">
                    <?php
                    if (isset($_POST['userid'])) {
                      include('../config.php');
                      $result = mysqli_query($handle, "SELECT * FROM patient_reading where patient_id='" . $_POST['userid'] . "';");
                      if (mysqli_num_rows($result) > 0)
                        require('chart.php');
                      else
                        echo "<div class='text-center mt-8'><i>No records to display</i></div>";
                    }
                    ?>
                  </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <div class="card shadow">
                    <h1 class="card-header">Stats</h1>
                    <div class="card-body" style='overflow-x:scroll;'>
                      <?php
                      if (isset($_POST['userid'])) {
                        require('accuracy.php');
                      } else
                        echo "<div class='text-center'><i>Select user</i></div>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="row justify-content-center">
        <div class="text-center text-muted p-5">
          Glucoguide Team
        </div>
      </div>
    </div>
  </div>
</body>

</html>