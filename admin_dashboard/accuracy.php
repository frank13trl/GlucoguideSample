<?php

include('../config.php');
if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    if (isset($_POST['userid'])) {
        $id=$_POST['userid'];
        $result = mysqli_query($handle, "SELECT COUNT(*) FROM patient_reading WHERE patient_id='$id';");
        $row = mysqli_fetch_row($result);
        $count =  $row[0];
        $result = mysqli_query($handle, "SELECT COUNT(*) FROM patient_reading WHERE patient_id='$id' and pricked != 0;");
        $row = mysqli_fetch_row($result);
        $pcount = $row[0];
        $result = mysqli_query($handle, "SELECT MAX(ABS(reading_avg - pricked)), MIN(ABS(reading_avg - pricked)), AVG(ABS(reading_avg-pricked)) FROM patient_reading WHERE patient_id='$id' and pricked != 0;");
        $row = mysqli_fetch_row($result);
        $maxv = $row[0];
        $minv = $row[1];
        $avgv = $row[2];
        $result = mysqli_query($handle, "SELECT MAX((ABS(reading_avg-pricked)/pricked)*100), MIN((ABS(reading_avg-pricked)/pricked)*100), AVG((ABS(reading_avg-pricked)/pricked)*100) FROM `patient_reading` WHERE patient_id='$id' and pricked!=0;");
        $row = mysqli_fetch_row($result);
        $maxerr = $row[0];
        $minerr = $row[1];
        $avgerr = $row[2];

        echo "<table class='table table-hover'>

                  <tr><th>Total number of readings</th><td>$count</td></tr>
                  <tr><th>Number of times pricked</th><td>$pcount</td></tr>
                  <tr><th>Maximum recorded variation</th><td>$maxv</td></tr>
                  <tr><th>Minimum recorded variation</th><td>$minv</td></tr>
                  <tr><th>Average of variation</th><td>$avgv</td></tr>
                  <tr><th>Maximum % error</th><td>$maxerr %</td></tr>
                  <tr><th>Minimum % error</th><td>$minerr %</td></tr>
                  <tr><th>Average % error</th><td>$avgerr %</td></tr>

                  </tbody></table>";
    }
}