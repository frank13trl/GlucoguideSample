<?php
session_start();
if (isset($_POST['send'])) {
    include('../config.php');
    if (empty($_POST["msg"])) {
        echo "<script>
                        function goBack() {
                            window.history.back();
                        }
                        goBack();
                    </script>";
    } else {
        if (mysqli_connect_error()) {
            echo "<span class='text-danger'>Unable to connect to database!</span>";
        } else {
            $sql2 = "select * from casefile where patient_id = '" . $_SESSION['userid'] . "';";
            $result2 = mysqli_query($handle, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $did = $row2["doctor_id"];
            echo $_POST['msg'];
            $query = mysqli_query($handle, "Insert into notification values (default, '" . $_SESSION['userid'] . "','" . $did . "','" . $_POST["msg"] . "', default, default);");
            if ($query) {
                echo "<script>
                        function goBack() {
                            window.history.back();
                        }
                        goBack();
                    </script>";
            } else {
                echo "No";
            }
        }
    }
    mysqli_close($handle);
}
