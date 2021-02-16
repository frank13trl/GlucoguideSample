<?php

include ('../config.php');
if ($handle->connect_error) {
    die("Connection failed: " . $handle->connect_error);
}
$pid = $_SESSION['userid'];


$sql = "select * from casefile where patient_id = '$pid'";
$result = mysqli_query($handle, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);


if ($count == 1) {

    $val = $row['default_testcount'] - 1;
    $_SESSION["lower"] = $row['lower_normal'];
    $_SESSION["upper"] = $row['upper_normal'];
}

?>
<!DOCTYPE html>

<head>

    <script type="text/javascript">
        var x = "<?php echo $val; ?>";



        function add_feed() {
            var div1 = document.createElement('div');

            div1.innerHTML = document.getElementById('newlinktpl').innerHTML;

            document.getElementById('newlink').appendChild(div1);

            x = x - 1;


            if (x == 0) {
                document.getElementById("addnew").style.display = "none";
                document.getElementById("submit").style.display = "block";






            }

        }
    </script>

    <style>
        .feed {
            padding: 5px 0
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <table style="margin: 20px;">
            <tr>
                <td valign=top>
                    <h3 style="padding: 30px;">Enter your readings : </h3>
                </td>
                <td>
                    <div id="newlink">
                        <div class="feed">
                            <input type="text" name="values[]" class='form-control' required>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <p class="push">
            <br>
            <input type='button' id="addnew" class='btn btn-primary m-' onClick="javascript:add_feed()" style="display:block;" value='Next'>
            <input type="submit" class='btn btn-primary' style="display:none;" id="submit" name="submit1"><br>
            <input type="reset" class='btn btn-warning' name="reset1"><br>

        </p>

    </form>
    <?php
    include ('readings_check.php');


    ?>
    <?php
    if (isset($_SESSION["msg"])) {
        $m = $_SESSION['msg'];
        echo $m;
        unset($_SESSION['msg']);
    }
    ?>
    <!-- Template. This whole data will be added directly to working form above -->
    <div id="newlinktpl" style="display:none;">
        <div class="feed">
            <input type="text" name="values[]" class='form-control' required>
        </div>
    </div>
</body>

</html>