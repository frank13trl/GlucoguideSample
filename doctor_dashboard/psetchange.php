<?php
echo "<table class='table table-hover'>
                
                  <tr>
                    <th>Number of readings</th>
                    <th>Low value</th>
                    <th>High value</th>
                  </tr>
                
                <tbody>";
$settings = mysqli_query($handle, "Select * from casefile where patient_id='" . $_GET['patient'] . "';");
if (mysqli_num_rows($settings) == 0) {
    echo "<tr><td colspan = 5 align=center>No settings</td></tr>";
} else {
    $settlist = mysqli_fetch_array($settings);
    $ccount = $settlist['default_testcount'];
    $clval = $settlist['lower_normal'];
    $chval = $settlist['upper_normal'];
    echo "<tr><form action='patientinfo.php?patient=" . $_GET['patient'] . "&name=" . $_GET['name'] . "' method='POST'>
                <td>
        <input type='text' name='tcount' class='form-control mb-3'>Current: " . $settlist['default_testcount'] . "</td>
                <td>
        <input type='text' name='lval' class='form-control mb-3'>Current: " . $settlist['lower_normal'] . "</td>
                <td>
        <input type='text' name='hval' class='form-control mb-3'>Current: " . $settlist['upper_normal'] . "</td>
              </tr>
              <tr><td colspan = 3 align=center>
              <br/><input type='submit' class='btn btn-primary' value='Update' name='change'></td>
              </form></tr>";
}
if (isset($_POST['change']) && $_POST['change'] == "Update") {
    if (!empty($_POST['tcount'] || $_POST['lval'] || $_POST['hval'])) {
        if (empty($_POST['tcount'])) $_POST['tcount'] = $ccount;
        if (empty($_POST['lval'])) $_POST['lval'] = $clval;
        if (empty($_POST['hval'])) $_POST['hval'] = $chval;
        include ('../config.php');
        $change = mysqli_query($handle, "Update casefile set 
                                                    default_testcount='" . $_POST['tcount'] . "',
                                                    lower_normal='" . $_POST['lval'] . "',
                                                    upper_normal='" . $_POST['hval'] . "' where patient_id='" . $_GET['patient'] . "';");
        if ($change) {
            $msg="<div class='text-success text-center' id='status'>Settings Updated</div>";
            echo "<script>window.location.replace('patientinfo.php?patient=" . $_GET['patient'] . "&name=" . $_GET['name'] . "');</script>";
        } else {
            echo mysqli_error($change);
        }
    }
}
echo "</tbody></table>";
