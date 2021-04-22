<?php

include('../config.php');
if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    if (isset($_GET['patient'])) {
        $id=$_GET['patient'];
        $result = mysqli_query($handle, "SELECT COUNT(*) FROM patient_reading WHERE patient_id='$id';");
        $row = mysqli_fetch_row($result);
        $count =  $row[0];
        $result = mysqli_query($handle, "SELECT COUNT(*) FROM patient_reading WHERE patient_id='$id' and pricked != 0;");
        $row = mysqli_fetch_row($result);
        $pcount = $row[0];
        $result = mysqli_query($handle, "SELECT MAX(reading_avg), MIN(reading_avg), AVG(reading_avg) FROM patient_reading WHERE patient_id='$id';");
        $row = mysqli_fetch_row($result);
        $maxr = $row[0];
        $minr = $row[1];
        $avgr = $row[2];
        $result = mysqli_query($handle, "SELECT MAX(pricked), MIN(pricked), AVG(pricked) FROM `patient_reading` WHERE patient_id='$id' and pricked!=0;");
        $row = mysqli_fetch_row($result);
        $maxp = $row[0];
        $minp = $row[1];
        $avgp = $row[2];

        echo "<table class='table table-hover'>

                  <tr><th>Total number of glucoguide readings</th><td>$count</td></tr>
                  <tr><th>Maximum glucoguide reading</th><td>$maxr</td></tr>
                  <tr><th>Minimum glucoguide reading</th><td>$minr</td></tr>
                  <tr><th>Average glucoguide reading</th><td>$avgr</td></tr>
                  <tr style='border-top : solid grey;'><th>Total number of times pricked</th><td>$pcount</td></tr>
                  <tr><th>Maximum prick value</th><td>$maxp</td></tr>
                  <tr><th>Minimum prick value</th><td>$minp</td></tr>
                  <tr><th>Average prick value</th><td>$avgp</td></tr>

                  </tbody></table>";
    }
}