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

            $result = mysqli_query($handle, "SELECT * FROM casefile WHERE patient_id = '" . $_SESSION['userid'] . "';");
            $row = mysqli_fetch_assoc($result2);
            $did = $row["doctor_id"];
            
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
