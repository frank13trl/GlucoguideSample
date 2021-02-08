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
<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login_page.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  
  ?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php echo $_GET['patient']; ?>'s Report
  </title>
  <!-- Favicon -->
  <!-- <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png"> -->
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
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
        <!-- <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
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
        <li class="nav-item  active ">
          <a class="nav-link  active " href="doc_dashboard.php">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="doctor_settings.php">
            <i class="ni ni-single-02 text-yellow"></i> Settings
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link " href="./examples/tables.html">
            <i class="ni ni-bullet-list-67 text-red"></i> Tables
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
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
        <a class="h4 mb-0 text-white d-none d-lg-inline-block" href="#">Patient Report</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/custom/profile.jpg">
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
    <?php
    $_SESSION['patient']=$_GET['patient'];
    $_SESSION['name']=$_GET['name'];
    echo "<h1 class=\"p-5\">";echo $_GET['name']; echo"'s Report</h1>";
    $patienthandle = mysqli_connect("localhost", "root", "", "glucoguide");
    if (mysqli_connect_error()) {
      echo "<span class='text-danger'>Unable to connect to database!</span>";
    } else {
      echo "<table class=\"table align-items-center table-flush\">
                <thead>
                  <tr>
                    <th scope=\"col\">Serial No.</th>
                    <th scope=\"col\">Average Value</th>
                    <th scope=\"col\">Pricked Value</th>
                    <th scope=\"col\">Updated On</th>
                  </tr>
                </thead>
                <tbody>";
      $count = 1;
      $list = mysqli_query($patienthandle, "Select * from patient_reading where patient_id='".$_GET['patient']."';");
      if (mysqli_num_rows($list) == 0) {
        echo "<tr><td colspan = 5 align=center>No records yet !</td></tr>";
      } else {
        while ($info = mysqli_fetch_array($list)) {
          echo "<tr>
                  <td>"
            . $count .
            "</td>
             <th>"
            . $info['reading_avg'] .
            "</th>
             <th>";
             if($info['pricked']==0) echo "Nil";
             else echo $info['pricked'];
            echo "</th>
                  <td>"
            . $info['action_taken'] .
            "</td>
                </tr>";
          $count++;
        }
      }
      echo "</tbody></table>";
    }
    include ('psetchange.php')
    ?>

    <div class="container-fluid">
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-6">
            <div class="text-center text-muted fixed-bottom mb-5">
              Glucoguide Team
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</body>

</html>