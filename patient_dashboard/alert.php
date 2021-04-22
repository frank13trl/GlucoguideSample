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
    if (($values[1] > $values[3]) && ($values[0] > $values[3])) {
      $flag = 3;
      if (($values[2] > $values[3]) && ($values[1] >= $values[2] && $values[0] >= $values[1]))
        $flag = 1;
    }
    array_push($values, $row[3]);
    if (($values[1] < $values[4]) && ($values[0] < $values[4])) {
      $flag = 3;
      if (($values[2] < $values[4]) && ($values[1] <= $values[2] && $values[0] <= $values[1]))
        $flag = 2;
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="alert alert-danger alert-dismissible fade show" id="halert" style="display: none;">
    <span class="alert-icon"><b>!</b></span>
    <span class="alert-text"><strong>Alert! </strong>Your glucose levels have been <b>rising</b> abnormally. Consult your doctor
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="alert alert-danger alert-dismissible fade show" id="lalert" style="display: none;">
    <span class="alert-icon"><b>!</b></span>
    <span class="alert-text"><strong>Alert! </strong>Your glucose levels have been <b>falling</b> abnormally. Consult your doctor
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="alert alert-warning alert-dismissible fade show" id="warn" style="display: none;">
    <span class="alert-icon"><i class="ni ni-sound-wave"></i></span>
    <span class="alert-text"><strong>Oops! </strong>Your glucose levels were abormal recently
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
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