<?php
echo "<table class='table table-hover'>
                
                  <tr>
                    <th>Number of readings</th>
                    <th>Low value</th>
                    <th>High value</th>
                  </tr>
                <tbody>";

$settings = mysqli_query($handle, "SELECT * FROM casefile WHERE patient_id='$patient';");
if (mysqli_num_rows($settings) == 0) {
    echo "<tr><td colspan = 5 align=center>No settings</td></tr>";
} else {
    $settlist = mysqli_fetch_array($settings);

    $pccount = $settlist['default_testcount'];
    $pclval = $settlist['lower_normal'];
    $pchval = $settlist['upper_normal'];
    echo "<tr><form action='patientinfo.php?patient=$patient&name=$name' method='POST'>
                <td><input type='text' name='tcount' class='form-control mb-3'>Current: $pccount</td>
                <td><input type='text' name='lval' class='form-control mb-3'>Current: $pclval</td>
                <td><input type='text' name='hval' class='form-control mb-3'>Current: $pchval</td>
              </tr>
              <tr>
                <td colspan = 3 align=center>
                <br/><input type='submit' class='btn btn-primary' value='Update' name='change'></td>
              </form></tr>";
}
if (isset($_POST['change']) && $_POST['change'] == "Update") {
    if (!empty($_POST['tcount'] || $_POST['lval'] || $_POST['hval'])) {

        if (empty($_POST['tcount'])) $_POST['tcount'] = $pccount;
        if (empty($_POST['lval'])) $_POST['lval'] = $pclval;
        if (empty($_POST['hval'])) $_POST['hval'] = $pchval;
        include ('../config.php');
        $change = mysqli_query($handle, "UPDATE casefile SET 
                                                    default_testcount='" . $_POST['tcount'] . "',
                                                    lower_normal='" . $_POST['lval'] . "',
                                                    upper_normal='" . $_POST['hval'] . "' WHERE patient_id='$patient';");
        if ($change) {
            $_SESSION['msg']="Settings Updated";
            echo "<script>window.location.replace('patientinfo.php?patient=$patient&name=$name');</script>";
        } else {
            echo mysqli_error($change);
        }
    }
}
echo "</tbody></table>";
