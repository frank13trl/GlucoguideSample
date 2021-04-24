<?php
include('../config.php');

$id = $_SESSION['userid'];

if (mysqli_connect_error()) {
    echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
    echo "<table class='table table-hover'><thead>
                  <tr>
                    <th>Number of readings</th>
                    <th>Low value</th>
                    <th>High value</th>
                  </tr></thead>
                <tbody>";
}
$dsettings = mysqli_query($handle, "Select * from doctor_settings where doctor_id='$id';");
if (mysqli_num_rows($dsettings) == 0) {
    echo "<tr><td colspan = 5 align=center>No settings</td></tr>";
} else {
    $dsettlist = mysqli_fetch_array($dsettings);

    $ccount = $dsettlist['default_testcount'];
    $clval = $dsettlist['lower_normal'];
    $chval = $dsettlist['upper_normal'];

    echo "<tr><form action='doctor_settings.php' method='POST'>
                <td><input type='text' name='dtcount' class='form-control w-50 mb-3'>Current: $ccount</td>
                <td><input type='text' name='dlval' class='form-control w-50 mb-3'>Current: $clval</td>
                <td><input type='text' name='dhval' class='form-control w-50 mb-3'> Current: $chval</td>
            </tr>
            <tr>
                <td colspan = 3 align=center><br/>
                <input type='submit' class='btn btn-primary' value='Update' name='dchange'></td>
            </form></tr>";
}
if (isset($_POST['dchange']) && $_POST['dchange'] == "Update") {
    if (!empty($_POST['dtcount'] || $_POST['dlval'] || $_POST['dhval'])) {

        if (empty($_POST['dtcount'])) $_POST['dtcount'] = $ccount;
        if (empty($_POST['dlval'])) $_POST['dlval'] = $clval;
        if (empty($_POST['dhval'])) $_POST['dhval'] = $chval;

        include('../config.php');

        $change = mysqli_query($handle, "UPDATE doctor_settings SET 
                                                        default_testcount='" . $_POST['dtcount'] . "',
                                                        lower_normal='" . $_POST['dlval'] . "',
                                                        upper_normal='" . $_POST['dhval'] . "' WHERE doctor_id='$id';");
        if ($change) {
            $_SESSION['msg'] = "Settings Updated";
            echo "<script>window.location.replace('doctor_settings.php');</script>";
        } else {
            echo mysqli_error($change);
        }
    }
}
echo "</tbody></table>";
