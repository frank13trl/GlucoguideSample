<?php
session_start();
if (isset($_POST['mark'])) {
    include('../config.php');

    if (mysqli_connect_error()) {
        echo "<span class='text-danger'>Unable to connect to database!</span>";
    } else {
        $query = mysqli_query($handle, "UPDATE notification set msg_read=1 where id=".$_POST['mark'].";");
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
    mysqli_close($handle);
}
