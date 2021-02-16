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
    Register
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
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
          <h1 class="text-white text-capitalize">Glucoguide</h1>
          <!-- <img src="./assets/img/brand/white.png" /> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="./assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="login_page.php">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Login</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-4 mt--5">
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
              <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="Name" type="text" name="name" required>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input class="form-control" placeholder="User ID" type="text" name="uid" maxlength="5" required>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="pwd" required>
                  </div>

                </div>
                <!-- <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm password" type="password" name="pwdc">
                  </div>

                </div> -->
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="mail" required>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" placeholder="Phone" type="number" name="phn" required>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="City" type="text" name="cty" required>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                    </div>
                    <select class="form-control" onchange="optselect(this);" name="cat" required>
                      <option disabled selected>Category</option>
                      <option value="Doctor">Doctor</option>
                      <option value="Patient">Patient</option>
                    </select>
                  </div>

                </div>
                <div class="form-group" id="hospital" style="display: none;">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-building"></i></span>
                    </div>
                    <input class="form-control" placeholder="Hospital" type="text" name="hsp">
                  </div>

                </div>
                <div class="form-group" id="description" style="display: none;">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                    </div>
                    <textarea class="form-control" placeholder="Description (optional)" rows="5" style="resize: none;" name="desc"></textarea>
                  </div>
                </div>
                <div class="form-group" id="docid" style="display: none;">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-ambulance"></i></span>
                    </div>
                    <select class="form-control" name="docid">
                      <option selected disabled>Select your doctor</option>
                      <?php
                      include 'doc_option.php';
                      ?>
                    </select>
                  </div>

                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="signup" value="true">Create Account</button>
                </div>
                <div class="text-muted text-center mt-3"><small>
                    <?php
                    include 'register.php';
                    ?></small></div>
              </form>
            </div>
          </div>
          <div class="col-12 text-center mt-4">
            Already a member? <a href="login_page.php" class="text-light"><small> Sign In</small></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container mt--4">
      <div class="row align-items-center justify-content-center">
        <div class="col-xl-6">
          <div class="text-center text-muted">
            <span class="font-weight-bold ml-1">Glucoguide Team</span>
          </div>
        </div>
      </div>
    </div>
  </footer>
  </div>
</body>

</html>