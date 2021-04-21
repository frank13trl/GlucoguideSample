<?php
include('../config.php');
$pid = $_SESSION['userid'];
$values = array();
$flag = 0;

if (mysqli_connect_error()) {
  echo "<span class='text-danger'>Unable to connect to database!</span>";
} else {
  $result = mysqli_query($handle, "SELECT r.reading_avg, r.pricked, c.upper_normal, c.lower_normal FROM patient_reading r 
                                   JOIN casefile c ON r.patient_id=c.patient_id where r.patient_id='$pid' ORDER BY r.action_taken DESC LIMIT 3;");

  if (mysqli_num_rows($result) == 3) {

    while ($row = mysqli_fetch_array($result)) {
      if ($row[1] == 0) {
        array_push($values, $row[0]);
      } else {
        array_push($values, $row[1]);
      }
    }
    mysqli_data_seek($result, 0);
    $row = mysqli_fetch_row($result);
    array_push($values, $row[2]);
    if (($values[1] > $values[3]) && ($values[0] >= $values[1])) {
      $flag = 3;
      if(($values[2] > $values[3]) && ($values[1] >= $values[2] && $values[0] >= $values[1]))
        $flag = 1;
    }
    array_push($values, $row[3]);
    if (($values[1] < $values[4]) && ($values[0] <= $values[1])) {
      $flag = 3;
      if(($values[2] < $values[4]) && ($values[1] <= $values[2] && $values[0] <= $values[1]))
        $flag = 2;
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .alert {
      padding: 20px;
      background-color: #f44336;
      color: white;
    }

    .warn {
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 7px;
      background-color: #ffbf00;
      color: white;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }
  </style>
</head>

<body>
  <div class="alert" id="halert" style="display: none;">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Alert! </strong>Your glucose levels have been rising abnormally. Consult your doctor
  </div>
  <div class="alert" id="lalert" style="display: none;">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Alert! </strong>Your glucose levels have been falling abnormally. Consult your doctor
  </div>
  <div class="warn" id="warn" style="display: none;">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Oops! </strong>Your glucose levels were abormal recently
  </div>
  <?php
  echo $flag;
  if ($flag == 1) {
    echo "<script>document.getElementById('halert').style.display = 'block';</script>";
  }
  if ($flag == 2) {
    echo "<script>document.getElementById('lalert').style.display = 'block';</script>";
  }
  if ($flag == 3) {
    echo "<script>document.getElementById('warn').style.display = 'block';</script>";
  }
  ?>

</body>

</html>