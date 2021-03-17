<?php
// create database connectivity

include ('../config.php');

// fetch data from student table..
$sql = "SELECT * FROM notification n INNER JOIN login AS l ON n.msg_from = l.userid where msg_to='" . $_SESSION['userid'] . "' order by sent_on desc";

$query = $handle->query($sql);
if ($query->num_rows  > 0) {
	echo "<form method='POST' action='read.php'>
	<table class='table table-hover table-striped'>
	<tbody>";
	while ($row = $query->fetch_assoc()) {
		$pid = $row['userid'];
		$pname = $row['name'];
		echo "<tr>
				<td><a href='viewmsg.php?patient=$pid&name=$pname'>" . $row['name'] . "</a></td>
				<td style='word-wrap: break-word; white-space: pre-wrap;'>" . $row['message'] . "</td>
				<td style='white-space: pre-wrap;'>" . $row['sent_on'] . "</td>
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
