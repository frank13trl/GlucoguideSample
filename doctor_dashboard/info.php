<?php
include('../config.php');

$query = mysqli_query($handle, "SELECT COUNT(*) FROM casefile WHERE doctor_id='" . $_SESSION['userid'] . "';");
$query1 = mysqli_query($handle, "SELECT COUNT(DISTINCT patient_id) FROM patient_reading WHERE DATE(action_taken)+0 > DATE(NOW())-1 AND patient_id IN
								(SELECT patient_id FROM casefile where doctor_id='" . $_SESSION['userid'] . "')");
if ($query) {
	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_assoc($query)) {
			echo "Number of patients : " . $row['COUNT(*)'];

			if ($query1) {
				if (mysqli_num_rows($query1) > 0) {
					while ($row = mysqli_fetch_array($query1)) {
						echo "<h3 class='mt-3 mb-0'>Today Active : " . $row[0] . "</h3>";
					}
				}
			}
		}
	} else {
		echo "<i>No patients yet</i>";
	}
}
