<?php
include ('config.php');
if (mysqli_connect_error()) {
    die("<span class='text-danger'>Unable to connect to database!</span>");

} else {
    $list = mysqli_query($handle, "SELECT userid, name FROM doctor_info;");

    while ($row = mysqli_fetch_array($list)) {
        echo "<option value=" . $row['userid'] . ">Dr. " . $row['name'] . "</option>";
    }
}