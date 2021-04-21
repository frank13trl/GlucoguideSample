<?php

include('../config.php');
if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    if (isset($_POST['userid'])) {
        $result = mysqli_query($handle, "Select p.userid,p.name,p.phone,c.doctor_id from patient_info p JOIN casefile c ON p.userid=c.patient_id WHERE p.userid='" . $_POST['userid'] . "';");
        $row = mysqli_fetch_array($result);
        echo "<table class='table table-striped table-hover'>
                  <tr>
                    
                    <th scope=\"col\">Patient ID</th>
                    <td>" . $row[0] . "</td>
                  </tr>
                  <tr>
                    
                    
                    <th scope=\"col\">Patient Name</th>
                    <td>" . $row[1] . "</td>
                  </tr>
                  <tr>
                    
                    
                    <th scope=\"col\">Doctor ID</th>
                    <td>" . $row[3] . "</td>
                  </tr>
                  <tr>
                    
                    <th scope=\"col\">Contact</th>
                    <td>" . $row[2] . "</td>
                  </tr>";
    }
    echo "</tbody></table>";
}
