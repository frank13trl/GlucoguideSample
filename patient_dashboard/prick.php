<?php
session_start();
if (isset($_POST['prick'])){
	$msg="";
	include ('../config.php');
	$pid=$_SESSION['userid'];
	$avg=$_SESSION['avg'];
	$fasting=$_SESSION['fasting'];
	$readings_string=$_SESSION['read'];
			$prickvalue =$_POST['prick_value'];
			$sql = "INSERT INTO patient_reading (patient_id, readings, fasting, reading_avg, pricked, action_taken)
												VALUES ('$pid','$readings_string','$fasting','$avg','$prickvalue',DEFAULT)";
		if ($handle->query($sql) === TRUE) {
				$msg = "<br/><span class='push text-success' id='status'>Your readings are updated successfully</span>";
				$_SESSION["msg"]=$msg;
		} 			
		else {
		echo "Error: " . $sql . "<br>" . $handle->error;
		}
		if(!empty($msg))
		{
			header("Location: pat_dashboard.php");
			exit();
		}
		$handle -> close();	
	 }
	 
	 ?>