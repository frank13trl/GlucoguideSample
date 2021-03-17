<?php
require_once('../config.php');

// fetch data from student table..
$sql = "SELECT COUNT(*) FROM casefile where doctor_id='" . $_SESSION['userid'] . "';";
$sql1 = "SELECT COUNT(DISTINCT patient_id) from patient_reading WHERE DATE(action_taken)+0 > DATE(NOW())-1 AND patient_id in
						  (SELECT patient_id FROM casefile where doctor_id='" . $_SESSION['userid'] . "')";
$query = $handle->query($sql);
$query1 = $handle->query($sql1);
if ($query) {
	if ($query->num_rows  > 0) {
		while ($row = $query->fetch_assoc()) {
			echo "Number of patients : " . $row['COUNT(*)'];
			if ($query1) {
				if ($query1->num_rows  > 0) {
					while ($row = $query1->fetch_array()) {
						echo "<h3 class='mt-3 mb-0'>Today Active : " . $row[0] . "</h3>";
					}
				}
			}
		}
	} else {
		echo "<i>No patients yet</i>";
	}
}
