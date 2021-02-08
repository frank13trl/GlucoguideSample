<?php
if (isset($_POST['signup'])) {
    // session_start();
    $name = $_POST['name'];
    $id = $_POST['uid'];
    $pass = $_POST['pwd'];
    // $passc = $_POST['pwdc'];
    $email = $_POST['mail'];
    $phone = $_POST['phn'];
    $city = $_POST['cty'];
    $category = $_POST['cat'];

$reghandle = mysqli_connect("localhost", "root", "", "glucoguide");
if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    $checkexist = mysqli_query($reghandle, "Select * from login where userid='" . $id . "';");
    $accexists = mysqli_fetch_row($checkexist);
    if (empty($accexists)) {
        if ($category == "Doctor") {
            $hospital = $_POST['hsp'];
            $descript = $_POST['desc'];
            $dlogquery = mysqli_query($reghandle, "Insert into login values(DEFAULT,'" . $name . "','" . $id . "','" . $pass . "','" . $category . "',DEFAULT);");
            if ($dlogquery) {
                $dinfquery = mysqli_query($reghandle, "Insert into doctor_info values(DEFAULT,'" . $id . "','" . $name . "','" . $email . "','" . $phone . "','" . $hospital . "','" . $city . "','" . $descript . "');");
                if ($dinfquery) {
                    $dsetquery = mysqli_query($reghandle, "Insert into doctor_settings values('" . $id . "',DEFAULT,DEFAULT,DEFAULT);");
                    if ($dsetquery) {
                        // header("Location: login_page.php");
                        echo "<span class='text-success'>Account added successfully</span>";
                    } else {
                        echo (mysqli_error($reghandle));
                        echo "<span class='text-danger'>Error adding account!</span>";
                    }
                } else {
                    echo (mysqli_error($reghandle));
                    echo "<span class='text-warning'>Error adding account details!</span>";
                }
            } else {
                echo "<span class='text-warning'>Could not add login details! doctor</span>";
            }
        } elseif ($category == "Patient") {
            $did = $_POST['docid'];
            $plogquery = mysqli_query($reghandle, "Insert into login values(DEFAULT,'" . $name . "','" . $id . "','" . $pass . "','" . $category . "',DEFAULT);");
            if ($plogquery) {
                $pinfquery = mysqli_query($reghandle, "Insert into patient_info values(DEFAULT,'" . $id . "','" . $name . "','" . $email . "','" . $phone . "','" . $city . "');");
                if ($pinfquery) {
                    $psetquery = mysqli_query($reghandle, "Insert into casefile (patient_id,doctor_id,default_testcount,lower_normal,upper_normal) 
                                                                Select '" . $id . "',doctor_settings.* from doctor_settings where doctor_id='" . $did . "';");
                    if ($psetquery) {
                        // header("Location: login_page.php");
                        echo "<span class='text-success'>Account added successfully</span>";
                    } else {
                        echo "<span class='text-danger'>Error adding account!</span>";
                    }
                } else {
                    echo "<span class='text-warning'>Error adding account details!</span>";
                }
            } else {
                echo "<span class='text-warning'>Could not add login details! patient</span>";
            }
        } else {
            echo "<span class='text-warning>Select your category</span>";
        }
    } else {
        echo "Account already exists";
    }
}
mysqli_close($reghandle);
}
?>