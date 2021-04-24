<?php

include('../config.php');

$id = $_SESSION['userid'];

$query = mysqli_query($handle, "SELECT n.*,l.name,l.userid FROM notification n INNER JOIN login 
								AS l ON n.msg_from = l.userid WHERE msg_to='$id' AND msg_read=0 ORDER BY sent_on DESC");

if (mysqli_num_rows($query) > 0) {
	echo "<form method='POST' action='read.php'>
	<table class='table table-hover table-striped'>
	<tbody>";
	while ($row = mysqli_fetch_array($query)) {

		$pid = $row['userid'];
		$name = $row['name'];
		$msg = $row['message'];
		$date = $row['sent_on'];

		echo "<tr>
				<td><a href='viewmsg.php?patient=$pid&name=$name'>$name</a></td>
				<td style='word-wrap: break-word; white-space: pre-wrap;'>$msg</td>
				<td style='white-space: pre-wrap;'>$date</td>
				<td>";

		if ($row['msg_read'] == 0) {
			echo "<button class='btn btn-primary btn-sm' type='submit' name='mark' value=" . $row['id'] . ">
			 Mark as read</button>
			 </td></tr>";
		}
	}
	echo "</tbody></table></form>";
} else {
	echo "<div class='text-center'><i>No messages to show</i></div>";
}
