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
    Register
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
  <script>
    function optselect(opt) {
      if (opt.value == "Doctor") {
        document.getElementById("hospital").style.display = "block";
        document.getElementById("description").style.display = "block";
        document.getElementById("docid").style.display = "none";
      } else {
        document.getElementById("hospital").style.display = "none";
        document.getElementById("description").style.display = "none";
        document.getElementById("docid").style.display = "block";
      }
    }
  </script>
  <style>
    .error {
      font-size: 14px;
      padding: 8px;
      color: #a94442;
      border: 1px solid #f2dede;
      border-radius: 5px;
    }

    .success {
      font-size: 14px;
      padding: 8px;
      color: #07a316;
      border: 1px solid #a7ebc2;
      border-radius: 5px;
    }
  </style>
</head>

<body class="bg-default">
  <?php require('validate.php'); ?>
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
            <a class="nav-link" href="login_page.php">
              <i class="ni ni-key-25 text-white"></i>
              <span class="lead text-white">Login</span>
            </a>
          </li>
        </ul>
      </div>
  </div>
  </nav>
  <!-- Header -->
  <div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
      <div class="header-body text-center mb-4 mt--2">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-white">Create your account</h1>
            <p class="text-lead text-light">Create your new Glucoguide account here. Fill in the details to create new account.</p>
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
    <!-- Table -->
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
              <small>Fill in the details below</small>
            </div>
            <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                  </div>

                  <input class="form-control" placeholder="Full Name" type="text" value="<?php echo $username; ?>" name="username">
                </div>
                <?php if (!empty($nameErr)) {
                  echo "<span class='error'>$nameErr</span>";
                } ?>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-badge"></i></span>
                  </div>
                  <input class="form-control" placeholder="User ID" type="text" value="<?php echo $userid; ?>" name="userid" maxlength="5">
                </div>
                <?php if (!empty($useridErr)) {
                  echo "<span class='error'>$useridErr</span>";
                } ?>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Password" type="password" value="<?php echo $password; ?>" name="password">
                </div>
                <?php if (!empty($passErr)) {
                  echo "<span class='error'>$passErr</span>";
                } ?>
              </div>

              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="Email" type="email" value="<?php echo $email; ?>" name="email">
                </div>
                <?php if (!empty($emailErr)) {
                  echo "<span class='error'>$emailErr</span>";
                } ?>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                  </div>
                  <input class="form-control" placeholder="Phone" type="number" value="<?php echo $phone; ?>" name="phone">
                </div>
                <?php if (!empty($phoneErr)) {
                  echo "<span class='error'>$phoneErr</span>";
                } ?>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                  </div>
                  <input class="form-control" placeholder="City" type="text" value="<?php echo $city; ?>" name="city">
                </div>
                <?php if (!empty($cityErr)) {
                  echo "<span class='error'>$cityErr</span>";
                } ?>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                  </div>
                  <select class="form-control" onchange="optselect(this);" name="category">
                    <option disabled selected>Category</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Patient">Patient</option>
                  </select>
                </div>
                <?php if (!empty($categoryErr)) {
                  echo "<span class='error'>";
                  echo $categoryErr;
                  echo "</span>";
                } ?>
                <?php if (!empty($selectErr)) {
                  echo "<span class='error'>$selectErr</span>";
                } ?>
              </div>
              <div class="form-group" id="hospital" style="display: none;">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-building"></i></span>
                  </div>
                  <input class="form-control" placeholder="Hospital" type="text" name="hospital">
                </div>
              </div>
              <div class="form-group" id="description" style="display: none;">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                  </div>
                  <textarea class="form-control" placeholder="Description (optional)" rows="5" style="resize: none;" name="description"></textarea>
                </div>
              </div>
              <div class="form-group" id="docid" style="display: none;">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                  </div>
                  <select class="form-control" name="docid">
                    <option disabled selected>Select your doctor</option>
                    <?php
                    require('doc_option.php');
                    ?>
                  </select>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" name="reg_user" class="btn btn-primary">Create Account</button>
              </div>
              <div class="text-muted text-center mt-3"><small>
                  <?php if (!empty($message1)) {
                    echo "<span class='success'>$message1</span>";
                  } if (!empty($message2)) {
                    echo "<span class='error'>$message2</span>";
                  } ?>
                </small></div>
            </form>
          </div>
        </div>
        <div class="col-12 text-center mt-4">
          Already a member? <a href="login_page.php" class="text-light">Sign In</a>
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