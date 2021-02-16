<?php
$nameErr = $useridErr = $emailErr = $passErr = $pass2Err = $emailErr = $phoneErr = $cityErr = $categoryErr = $selectErr = "";
$username = $userid = $password = $email = $city = $phone = $category = $docid = $hospital = $desc = $message1 = $message2 = $loginErr = NULL;

if (isset($_POST['reg_user'])) {



  include ('config.php');
  if (empty($_POST["username"])) {
    $nameErr = "Name is required";
  } else {
    $username = $_POST["username"];
  }
  if (empty($_POST["userid"])) {
    $useridErr = "User ID is required";
  } else {
    $userid = $_POST["userid"];
    $user_check_query = "SELECT * FROM login WHERE userid='$userid'";
    $result = mysqli_query($handle, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
      if ($user['userid'] === $userid) {
        $useridErr = "Userid already taken";
      }
    }
  }

  if (empty($_POST["password"])) {
    $passErr = "Please enter a password";
  } elseif (strlen($_POST["password"]) < 6) {
    $passErr = "Password must have atleast 6 characters.";
  } else {
    $password = $_POST["password"];
  }


  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
  }
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = $_POST["phone"];
  }

  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
    $city = $_POST["city"];
  }
  if (empty($_POST["category"])) {
    $categoryErr = "Select a category";
  } else {
    $category = $_POST["category"];
    if ($category == "Doctor") {
      if (!empty($_POST["description"])) {
        $desc = $_POST["description"];
      } else {
        $desc = "NIL";
      }

      if (empty($_POST["hospital"])) {
        $selectErr = "Select your hospital";
      } else {
        $hospital = $_POST["hospital"];
      }
    }
  }
  if ($category == "Patient") {
    if (empty($_POST["docid"])) {
      $selectErr = "Select your doctor";
    } else {
      $docid = $_POST["docid"];
    }
  }

  if (empty($nameErr) && empty($useridErr) && empty($emailErr) && empty($passErr) && empty($emailErr) && empty($phoneErr) && empty($cityErr) && empty($categoryErr) && empty($selectErr)) {
    $logquery = mysqli_query($handle, "Insert into login values(DEFAULT,'" . $username . "','" . $userid . "','" . $password . "','" . $category . "',DEFAULT);");
    if ($category == "Doctor") {
      $dinfquery = mysqli_query($handle, "Insert into doctor_info values(DEFAULT,'" . $userid . "','" . $username . "','" . $email . "','" . $phone . "','" . $hospital . "','" . $city . "','" . $desc . "');");
      $dsetquery = mysqli_query($handle, "Insert into doctor_settings values('" . $userid . "',DEFAULT,DEFAULT,DEFAULT);");
      if ($logquery && $dinfquery && $dsetquery) {
        $message1 = "Account added successfully<br/>Redirecting to login page";
        echo "<script>setTimeout(\"location.href = 'login_page.php';\",3000);</script>";
      } else {
        $message2 = "Could not add login details for doctor !";
      }
    }
    if ($category == "Patient") {
      $pinfquery = mysqli_query($handle, "Insert into patient_info values(DEFAULT,'" . $userid . "','" . $username . "','" . $email . "','" . $phone . "','" . $city . "');");
      $psetquery = mysqli_query($handle, "Insert into casefile (patient_id,doctor_id,default_testcount,lower_normal,upper_normal) 
                                                                Select '" . $userid . "',doctor_settings.* from doctor_settings where doctor_id='" . $docid . "';");
      if ($logquery && $pinfquery && $psetquery) {
        $message1 = "Account added successfully<br/>Redirecting to login page";
        session_start();
        echo "<script>setTimeout(\"location.href = 'login_page.php';\",3000);</script>";
      } else {
        $message2 = "Could not add login details for patient !";
      }
    }
  }
  mysqli_close($handle);
}

if (isset($_POST['login'])) {
  include ('config.php');
  if (empty($_POST["uid"]) || empty($_POST["pwd"])) {
    $loginErr = "User ID and Password is required";
  } else {
    $userid = $_POST['uid'];
    $password = $_POST['pwd'];
    // $remember = $_POST['remember'];

    if (mysqli_connect_error()) {
      echo "<span class='text-danger'>Unable to connect to database!</span>";
    } else {
      $login = mysqli_query($handle, "Select * from login where userid='" . $userid . "' and password='" . $password . "';");
      if (mysqli_num_rows($login) != 1) {
        $loginErr = "Invalid Username or Password";
      } else {

        $usernow = mysqli_fetch_array($login);
        $name = $usernow['name'];
        $category = $usernow['category'];
        $_SESSION["user"] = $name;
        $_SESSION["userid"] = $userid;
        $_SESSION["category"] = $category;
        $_SESSION["loggedin"] = true;
        if ($category === "Patient") {
          header('Location: ./patient_dashboard/pat_dashboard.php');
        }
        if ($category === "Doctor") {
          header('Location: ./doctor_dashboard/doc_dashboard.php');
        }
      }
    }
  }
  mysqli_close($handle);
}
