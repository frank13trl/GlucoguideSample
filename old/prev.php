<!DOCTYPE html>
<html>
<head>
<style>
#values {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#values td, #values th {
  border: 1px solid #ddd;
  text-align:center;
  padding: 8px;
}

#values tr:nth-child(even){background-color: #f2f2f2;}

#values tr:hover {background-color: #ddd;}

#values th {
  padding-top: 12px;
  padding-bottom: 12px;
  
  background-color: #6495ED;
  color: white;
}
</style>
</head>
<body>
<?php
session_start();
$conn = new mysqli('localhost','root','','glucoguide');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$pid=$_SESSION['userid'];


$sql = "select * from patient_reading where patient_id = '$pid' ";
$result = mysqli_query($conn, $sql);  
 
$count = mysqli_num_rows($result);  
          

			echo "<h1>Your Previous Readings</h1>";
			echo "<table id='values'>
    <tr>
        
        <th>readings</th>
		<th>reading_avg</th>
		<th>pricked</th>
		<th>action_taken</th>

    </tr>";
	

while ($row = mysqli_fetch_array($result)) {
    echo"
        <tr>
            <td>$row[1]</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>

        </tr>";

}

echo"
</table>";
		
		
?>
</body>
</html>
		