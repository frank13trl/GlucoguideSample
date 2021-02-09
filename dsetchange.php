<?php
        echo "<h1 class=\"p-5\">Your Current Settings</h1>";
        $patienthandle = mysqli_connect("localhost", "root", "", "glucoguide");
        if (mysqli_connect_error()) {
            echo "<span class='text-danger'>Unable to connect to database!</span>";
        } else {
            echo "<table class=\"table align-items-center table-flush\">
                <thead>
                  <tr>
                    <th scope=\"col\">Recommended number of readings</th>
                    <th scope=\"col\">Low value</th>
                    <th scope=\"col\">High value</th>
                  </tr>
                </thead>
                <tbody>";
        }
        $dsettings = mysqli_query($patienthandle, "Select * from doctor_settings where doctor_id='".$_SESSION['userid']."';");
        if (mysqli_num_rows($dsettings) == 0) {
            echo "<tr><td colspan = 5 align=center>No settings</td></tr>";
        } else {
            $dsettlist = mysqli_fetch_array($dsettings);
            $ccount=$dsettlist['default_testcount'];
            $clval=$dsettlist['lower_normal'];
            $chval=$dsettlist['upper_normal'];
            echo "<tr><form action='doctor_settings.php' method='POST'>
                <td>
                <input type='text' name='dtcount' class='form-control w-25' placeholder='Current - ".$dsettlist['default_testcount']."'></td>
                <td>
                 <input type='text' name='dlval' class='form-control w-25' placeholder='Current - ".$dsettlist['lower_normal']."'></td>
                <td>
                 <input type='text' name='dhval' class='form-control w-25' placeholder='Current - ".$dsettlist['upper_normal']."'></td>
              </tr>
              <tr><td colspan = 5 align=center><br/><div class='text-success'>";
              if(isset($_POST['msg'])){echo $_POST['msg'];} echo "</div>
              <br/><input type='submit' class='btn btn-primary' value='Update' name='dchange'></td>
              </form></tr>";
        }
        if (isset($_POST['dchange']) && $_POST['dchange'] == "Update") {
            if (!empty($_POST['dtcount'] || $_POST['dlval'] || $_POST['dhval'])) {
                if (empty($_POST['dtcount'])) $_POST['dtcount'] = $ccount;
                if (empty($_POST['dlval'])) $_POST['dlval'] = $clval;
                if (empty($_POST['dhval'])) $_POST['dhval'] = $chval;
                $psetchange = mysqli_connect("localhost", "root", "", "glucoguide");
                $change = mysqli_query($psetchange, "Update doctor_settings set 
                                                        default_testcount='" . $_POST['dtcount'] . "',
                                                        lower_normal='" . $_POST['dlval'] . "',
                                                        upper_normal='" . $_POST['dhval'] . "' where doctor_id='".$_SESSION['userid']."';");
                if ($change) {
                    echo "<script>window.location.replace('doctor_settings.php');</script>";
                } else {
                    echo mysqli_error($change);
                }
            }
        }
        echo "</tbody></table>";
