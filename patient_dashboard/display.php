<?php

include '../config.php';

$msgquery = mysqli_query($handle, "SELECT * FROM notification WHERE msg_from='" . $_SESSION['userid'] . "' ORDER BY sent_on DESC");
if (mysqli_num_rows($msgquery) > 0) {
	echo "<table class='table table-hover table-striped mt-3'>
				<tbody style='display: block; height: 270px; overflow-y: scroll'>";

	while ($row = mysqli_fetch_assoc($msgquery)) {

		echo "<tr><td style='word-wrap: break-word; white-space: pre-wrap;'>" . $row['message'] . "</td>
				  <td style='white-space: pre-wrap; text-align:center;'>" . $row['sent_on'] . "</td>
				<td>";
		if ($row['msg_read'])
			echo "<i class='ni ni-check-bold text-green'></i>
				</td></tr>";
	}
	echo "</tbody></table>";
} else {
	echo "<div class='text-center'><i>No messages to show</i></div>";
}
