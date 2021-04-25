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
  <!--   Scripts   -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://saleassist-static.s3.ap-south-1.amazonaws.com/widgets/widget.js"></script>
  <style>
    #status {
      font-size: 14px;
      width: fit-content;
      padding: 8px;
      color: #07a316;
      border: 1px solid #a7ebc2;
      border-radius: 5px;
      animation: fadeOut 2s forwards;
      animation-delay: 3s;
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }
  </style>
</head>

<body class="" onload='document.getElementById("msg").value="";'>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.html">
        <h1 class="display-3 text-blue">Glucoguide</h1>
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
            <a class="nav-link " href="prev_reading.php">
              <i class="ni ni-bullet-list-67 text-red"></i> Previous Readings
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
          <?php echo "Hello, " . $_SESSION['user']; ?>
        </div>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/custom/profile.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['user']; ?></span>
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
              <a href="prev_reading.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
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
    <div class="container-fluid mt--6">
      <div> <?php include 'alert.php' ?></div>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <h2 class="card-header">Use your glucoguide to read your glucose level</h2>
            <div class="card-body mt-4 mb-5">
              <div class="row">
                <div class="col-sm-6">
                  <?php include 'readings.php'; ?>
                </div>
                <div class="col-sm-6 border-left">
                  <?php include 'readings_check.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-md-12  mb-3">
          <div class="card shadow">
            <h3 class="card-header">Graphical Information</h3>
            <div class="card-body">
              <?php
              include('../config.php');
              if (mysqli_connect_error()) {
                echo "<span class='text-danger'>Unable to connect to database!</span>";
              } else {

                $result = mysqli_query($handle, "SELECT * FROM patient_reading WHERE patient_id='$pid'");
                if (mysqli_num_rows($result) == 0) {
                  echo "<h3 style=text-align:center; class='text-danger'>No readings to show graph</h3>";
                } else {
                  echo "<div>";
                  include('chart.php');
                  echo "</div>";
                }
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-3">
          <div class="card shadow">
            <h3 class="card-header">Message</h3>
            <div class="card-body" style="height: 550px;">
              <form role="form" method="POST" action="send.php">
                <div class="form-group">
                  <div class="input-group">
                    <textarea class="form-control" id="msg" name="msg"></textarea>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4" name="send">Send message</button>
                  </div>
                </div>
              </form>
              <hr>
              Previous messages<br />
              <?php include 'display.php'; ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card shadow">
            <h3 class="card-header">Talk to your doctor</h3>
            <div class="card-body">
              <div id="saleassistEmbed" style="height: 500px;"></div>
              <script>
                EmbeddableWidget.mount({
                  source_key: "11149d07-5e09-4522-ab95-584632295356",
                  parentElementId: "saleassistEmbed",
                  form_factor: "embed"
                });
              </script>
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