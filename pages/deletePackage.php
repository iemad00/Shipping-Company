<?php
require '../config/config.php';

// To check if the user is logined in or not
require 'LoginCheck.php';
if($userType == 'employee'){}
else if($userType == 'customer'){
    header('Location: MyPackages.php');
}else{
    header('Location: login.php');
}
$userID = $id;

$packageNb = $_GET['packageID'];
$sql = "DELETE FROM `Package` where packageNb = $packageNb";
$result = mysqli_query($conn,$sql);
if($result){   
    header("Location: ControlPanel.php");
}else{
    echo "<script> alert('Error Occurred!') </script>";
}

?>