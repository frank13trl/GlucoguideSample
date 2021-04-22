<?php

include('../config.php');
if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    if (isset($_POST['userid'])) {
        $result = mysqli_query($handle, "Select p.userid,p.name,p.phone,c.doctor_id from patient_info p JOIN casefile c ON p.userid=c.patient_id WHERE p.userid='" . $_POST['userid'] . "';");
        $row = mysqli_fetch_array($result);
        echo "<table class='table table-hover'>
                  <tr><td>Patient ID</td><th>" . $row[0] . "</th></tr>
                  <tr><td>Patient Name</td><th>" . $row[1] . "</th></tr>
                  <tr><td>Doctor ID</td><th>" . $row[3] . "</th></tr>
                  <tr><td>Contact</td><th>" . $row[2] . "</th></tr>";
    }
    echo "</tbody></table>";
}
