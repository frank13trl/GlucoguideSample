<?php

$sum=0;
$avg=0;
$prick=0;
$readings=array();
$pid=$_SESSION['userid'];

if(count($_POST))
{
	$len = count($_POST['values']);
	for ($i=0; $i < $len; $i++)
	{
		array_push($readings,$_POST['values'][$i] );
		
		$sum= $sum + $_POST['values'][$i];
		
    }
	$readings_string= implode(" , ",$readings);
	echo "<br/><span class='push'>Your Readings are : ".$readings_string."</span><br/>";
	$_SESSION["read"] = $readings_string;
	

    $avg=$sum/$len;
	$_SESSION["avg"] = $avg;
	$l_value=$_SESSION['lower'];
	$u_value=$_SESSION['upper'];
	echo "<br/><h3 class='push'>Average of your readings : <span class='text-primary'>" .$avg."</span></h3><br/>";
	if ($avg<$l_value || $avg > $u_value)
	{	
		echo "<form action='prick.php' method='post' class='push'>
		<input type='text' class='form-control w-25' name='prick_value' placeholder='Prick and input reading' required>
		<br/><br/><input type='submit' class='btn btn-primary p-20' name='prick' value='Update'>
		</form>";
		
	 
		
	}
	else {
		echo "<h4 class='push'>Your readings are normal<h4><br/>";
		$prick=0;
	$conn = new mysqli('localhost','root','','glucoguide');
		$sql = "INSERT INTO patient_reading (patient_id,readings,reading_avg,pricked,action_taken)
		VALUES ('$pid','$readings_string','$avg','$prick',DEFAULT)";

			if ($conn->query($sql) === TRUE) {
				echo "<span class='push text-success'>Your readings are updated successfully</span>";
		} 			
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn -> close();
}
}

?>