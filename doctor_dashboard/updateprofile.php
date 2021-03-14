<?php
include '../config.php';
if(isset($_POST['update'])){
    $mail = $_POST['modalemail'];
    $phn = $_POST['modalphone'];
    $city = $_POST['modalcity'];
    $hos = $_POST['modalhosp'];
    $des = $_POST['modaldecs'];
    $result = mysqli_query($handle,"UPDATE user SET email ='$mail', phone='$phn', hospital='$hos', description='$des'");
    if($result){
        echo "Updated";
    }
}
?>