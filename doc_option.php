<?php
$listgen = mysqli_connect("localhost", "root", "", "glucoguide");
if (mysqli_connect_error()) {
    die("<span class='text-danger'>Unable to connect to database!</span>");
} else {
    $list = mysqli_query($listgen, "Select userid, name from doctor_info;");
    while ($row = mysqli_fetch_array($list)) {
        echo "<option value=\"" . $row['userid'] . "\">" . $row['name'] . "</option>";
    }
}
