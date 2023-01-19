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

$userID = $_GET['userID'];
$sql = "DELETE FROM `user` where id = $userID";
$result = mysqli_query($conn,$sql);
if($result){   
    header("Location: customers.php");
}else{
    echo "<script> alert('Error Occurred!') </script>";
}

?>