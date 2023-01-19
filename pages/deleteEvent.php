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

$scheduleNb = $_GET['scheduleNb'];

$sql = "SELECT * FROM `transportationEvent` WHERE scheduleNb = $scheduleNb";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);
$packageNb = $row['packageNb'];
$url = 'event.php?packageID=';
$url .= $packageNb;

$sql = "DELETE FROM `transportationEvent` where scheduleNb = $scheduleNb";
$result = mysqli_query($conn,$sql);
if($result){   
    header("Location: $url");
}else{
    echo "<script> alert('Error Occurred!') </script>";
}

?>