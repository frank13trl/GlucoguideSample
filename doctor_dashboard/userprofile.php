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
  <title>Profile</title>
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
    #status {
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
        <li class="nav-item">
          <a class="nav-link" href="doc_dashboard.php">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="doctor_settings.php">
            <i class="ni ni-ui-04 text-red"></i> Settings
          </a>
        </li>
        <li class="nav-item  active ">
          <a class="nav-link  active " href="#">
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
        <a class="h1 mb-0 text-white text-capitalize d-none d-lg-inline-block" href="#">Profile</a>
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
    <?php $did = $_SESSION['userid'];
    $msg = "";
    include('../config.php');
    if (mysqli_connect_error()) {
      echo "<span class='text-danger'>Unable to connect to database!</span>";
    } else {
      $sql = "select * from doctor_info where userid = '$did'";
      $result = mysqli_query($handle, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      if ($count == 1) {

        $city = $row["city"];
        $email = $row["email"];
        $phone = $row["phone"];
        $hospital = $row["hospital"];
        $description = $row["description"];
      }
      if (isset($_POST['update'])) {
        if (!empty($_POST['city'])) {
          $city = $_POST["city"];
        }
        if (!empty($_POST["email"])) {
          $email = $_POST["email"];
        }
        if (!empty($_POST['phone'])) {
          $phone = $_POST["phone"];
        }
        if (!empty($_POST['hospital'])) {
          $hospital = $_POST["hospital"];
        }
        if (!empty($_POST['description'])) {
          $desc = $_POST["description"];
        }


        $sql = mysqli_query($handle, "Update doctor_info set 
                            city='$city',
														email='$email',
														phone='$phone',
														hospital='$hospital',
														description='$desc' where userid='$did';");
        if ($sql) {
          $msg = "<span class='text-success'>Profile Updated</span>";
        } else {
          $msg = "<span class='text-danger'>Error updating profile</span>";
        }
      }
    }
    ?>
    <!-- Dashboard info here-->
    <div class="container-fluid">
      <div class="card shadow mt-5">
        <h1 class="card-header">Your Profile</h1>
        <div class="card-body">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row">
              <div class="col">
                <h4 class="text-muted mb-4">Personal Information</h4>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="name">Name</label>
                        <input type="text" id="name" class="form-control form-control-alternative" value="<?php echo $_SESSION['user'] ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Userid</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $did; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="hospital">Hospital</label>
                        <input type="text" name="hospital" class="form-control form-control-alternative" value="<?php echo $hospital; ?>">
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="desc">Description</label>
                        <input type="text" name="description" class="form-control form-control-alternative" value="<?php echo $description; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Address -->
              <div class="col border-left">
                <h4 class="text-muted mb-4">Contact Information</h4>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-alternative" placeholder="email" value="<?php echo $email; ?>">
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="phone">Phone</label>
                        <input type="number" name="phone" class="form-control form-control-alternative" placeholder="phone" value="<?php echo $phone; ?>">
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" name="city" class="form-control form-control-alternative" placeholder="City" value="<?php echo $city; ?>">
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4" name="update">Edit Profile</button>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <?php if (!empty($msg)) {
                        echo "<div id='status' class='text-center'>$msg</div>";
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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