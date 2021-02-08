<?php
session_start();
if (isset($_POST['prick'])){
	$msg="";
	$conn = mysqli_connect('localhost','root','','glucoguide');
	$pid=$_SESSION['userid'];
	$avg=$_SESSION['avg'];
	$readings_string=$_SESSION['read'];
			$prickvalue =$_POST['prick_value'];
			echo $prickvalue;
			$sql = "INSERT INTO patient_reading (patient_id,readings,reading_avg,pricked,action_taken)
		VALUES ('$pid','$readings_string','$avg','$prickvalue',DEFAULT)";
		if ($conn->query($sql) === TRUE) {
				$msg = "Your readings are updated successfully";
				$_SESSION["msg"]=$msg;
		} 			
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		if(!empty($msg))
		{
			header("Location:pat_dashboard.php");
		}
		$conn -> close();	
	 }
	 
	 ?>