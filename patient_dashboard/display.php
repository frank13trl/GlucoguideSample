<?php
	// create database connectivity

	include '../config.php';
	
	// fetch data from student table..
	$msgdisp = "SELECT * FROM notification where msg_from='".$_SESSION['userid']."' order by sent_on desc";
	$msgquery = $handle->query($msgdisp);
	if ($msgquery->num_rows  > 0) {
		echo "<table class='table table-hover table-striped mt-3'>
		<tbody style='display: block; height: 270px; overflow-y: scroll'>";
		while ($row = $msgquery->fetch_assoc()) {
		echo "<tr>
				<td style='word-wrap: break-word; white-space: pre-wrap;'>".$row['message']."</td>
				<td style='white-space: pre-wrap; text-align:center;'>".$row['sent_on']."</td>
				<td>";
				if($row['msg_read'])
					echo "<i class='ni ni-check-bold text-green'></i>
				</td></tr>";
		}
	echo "</tbody></table>";
	}else{
		echo "<div class='text-center'><i>No messages to show</i></div>";
	}
	
?>
