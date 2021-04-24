<?php

$sum = 0;
$avg = 0;
$prick = 0;
$readings = array();
$pid = $_SESSION['userid'];

if (count($_POST)) {

	$len = count($_POST['values']);

	for ($i = 0; $i < $len; $i++) {
		array_push($readings, $_POST['values'][$i]);
		$sum = $sum + $_POST['values'][$i];
	}
	$readings_string = implode(" , ", $readings);
	echo "<br/><span>Your Readings are : " . $readings_string . "</span><br/>";

	$_SESSION["read"] = $readings_string;
	$avg = $sum / $len;
	$fasting = $_POST['fasting'];
	$_SESSION["avg"] = $avg;
	$_SESSION['fasting'] = $fasting;
	$l_value = $_SESSION['lower'];
	$u_value = $_SESSION['upper'];

	echo "<br/><h3 >Average of your readings : <span class='text-primary'>" . $avg . "</span></h3><br/>";

	if ($avg < $l_value || $avg > $u_value) {
		echo "<h2 class='text-danger'>Your readings are not normal, please input pricked value</h2>";
		echo "<form action='prick.php' method='POST' class='text-center'>
				<input type='text' class='form-control w-25' name='prick_value' style='border: 1px solid red' placeholder='Prick and input reading' required>
				<br/>
				<br/><input type='submit' class='btn btn-success p-20' name='prick' value='Update'>
			   </form>";

	} else {
		echo "<h4>Your readings are normal</h4><br/>";
		$prick = 0;

		include('../config.php');

		$sql = "INSERT INTO patient_reading (patient_id, readings, fasting,reading_avg, pricked, action_taken)
				VALUES ('$pid','$readings_string','$fasting','$avg','$prick',DEFAULT)";

		if ($handle->query($sql) === TRUE) {
			echo "<div class='row justify-content-center'>
					<span class='text-success' id='status'>Your readings are updated successfully</span></div>";
			echo "<script>document.getElementById('halert').style.display = 'none';</script>";
			echo "<script>document.getElementById('lalert').style.display = 'none';</script>";
			echo "<script>document.getElementById('warn').style.display = 'none';</script>";
		} else {
			echo "Error: $sql <br>" . $handle->error;
		}
		$handle->close();
	}
}
