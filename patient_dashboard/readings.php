<?php

include('../config.php');

if ($handle->connect_error) {
    die("Connection failed: " . $handle->connect_error);
}
$pid = $_SESSION['userid'];

$result = mysqli_query($handle, "SELECT * FROM casefile WHERE patient_id = '$pid'");
$row = mysqli_fetch_array($result);
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
                document.getElementById("submit").style.display = "inline";
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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="text-center"><br />

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="bf" name="fasting" value="before" checked>
            <label class="custom-control-label" for="bf">Before food</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="af" name="fasting" value="after">
            <label class="custom-control-label" for="af">After food</label>
        </div>

        <table style="margin: 30px;">
            <tr>
                <td valign=bottom style="padding-bottom: 10px;">
                    <h3>Glucoguide reading : </h3>
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
        <p><br>
            <input type="reset" class='btn btn-warning'>
            <input type="button" class='btn btn-primary' id="addnew" onClick="javascript:add_feed()" value='Next'>
            <input type="submit" class='btn btn-success' id="submit" style="display:none;">
        </p>
    </form>

    <?php
    if (isset($_SESSION["msg"])) {
        $m = $_SESSION['msg'];
        echo $m;
        unset($_SESSION['msg']);
    }
    ?>

    <div id="newlinktpl" style="display:none;">
        <div class="feed">
            <input type="text" name="values[]" class='form-control' required>
        </div>
    </div>
</body>

</html>