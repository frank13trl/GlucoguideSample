<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  if ($_SESSION["category"] === "admin") {
    header("Location: ./admin_dashboard/admin_dashboard.php");
    exit();
  }
  if ($_SESSION["category"] === "Patient") {
    header("Location: ./patient_dashboard/pat_dashboard.php");
    exit();
  }
  if ($_SESSION["category"] === "Doctor") {
    header("Location: ./doctor_dashboard/doc_dashboard.php");
    exit();
  }
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
    Login
  </title>
  <!-- Favicon -->
  <link href="./assets/img/custom/icon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <style>
    .error {
      font-size: 14px;
      padding: 8px;
      color: #a94442;
      border: 1px solid #f2dede;
      border-radius: 5px;
    }
  </style>
</head>

<body class="bg-default">
  <?php require ('validate.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="index.html">
          <div class="display-3 text-white text-capitalize">Glucoguide</div>
        </a>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="register_page.php">
              <i class="ni ni-circle-08 text-white"></i>
              <span class="lead text-white">Register</span>
            </a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light">Login to your Glucoguide account using your user id and password</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Sign in with credentials</small>
              </div>
              <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input class="form-control" placeholder="User ID" type="text" name="uid">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="pwd">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" name="login" value="login">Log In</button>
                </div>
                <div class="text-muted text-center mt-1"><small>
                    <?php if (!empty($loginErr)) {
                      echo "<span class='error'>$loginErr</span><br><br>";
                    }
                    ?>
                  </small></div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 text-center">
              <a href="register_page.php" class="text-light">Create new account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <div class="justify-content-center">
      <div class="text-center text-muted p-5">
        Glucoguide Team
      </div>
    </div>
  </div>
</body>

</html>