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
  
if(isset($_POST["addPackage"])){
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $length = $_POST['length'];
    $destination = $_POST['destination'];
    $dimensionalWeight = ($height*$width*$length)/5000;
    $shippingWeight = (int)max($weight,$dimensionalWeight);
    if($shippingWeight > 2){
        $price = 60 + (($shippingWeight-2) * 15);
    }
    else{
        $price = 30*$shippingWeight;
    }
    $insuranceAmount = 0.05*$price;
    $packageType = $_POST['packageType'];
    $userID = $_POST['userID'];
    
    if(is_numeric($userID)){
        $sql = "SELECT * FROM `user` WHERE id = '$userID'";
        $sql2 = "INSERT INTO `Package`(`weight`, `height`, `width`, `length`, `destination`, `price`, `insuranceAmount`, `finalDeliveryDate`, `packageType`, `userID`) 
        VALUES ('$weight','$height','$width','$length','$destination','$price','$insuranceAmount',null,'$packageType',$userID)";
    }else{
        $sql = "SELECT * FROM `user` WHERE username = '$userID'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $userID = $row['id'];

        $sql2 = "INSERT INTO `Package`(`weight`, `height`, `width`, `length`, `destination`, `price`, `insuranceAmount`, `finalDeliveryDate`, `packageType`, `userID`) 
        VALUES ('$weight','$height','$width','$length','$destination','$price','$insuranceAmount',null,'$packageType',$userID)";
    }

    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 0){      
        echo "<script> alert('User ID not found!') </script>";
    }else{

        $result = mysqli_query($conn,$sql2);
        if($result){
            header("Location: ControlPanel.php");
        }else{
            echo "<script> alert('Error Occurred!') </script>";
        }
    }   
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">

    <title>Add New Package</title>
</head>
<body>
<div class="card .bg-light bg-gradient" id="pup">
        <img class="package-img" src="../css/images/plus.png" alt="Add Package">

        <form method="post" autocomplete="off">
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="userID" placeholder="User ID or Username" required value=""> </div>
        <div class="mb-3"><input type="number" class="form-control" name="weight" placeholder="Package Weight" required value=""></div>

        <div class="row">
        <div class="col mb-3"><input type="number" inputmode="numeric" class="form-control" name="height" placeholder="Height" required value=""></div>
        <div class="col mb-3"><input type="number" class="form-control" name="width" placeholder="Width" required value=""></div>
        <div class="col mb-3"><input type="number" class="form-control" name="length" placeholder="Length" required value=""></div>
        </div>

        <div class="mb-3"><input type="text" class="form-control" name="destination" placeholder="Destination" required value=""></div>

        <select name="packageType" class="form-select  mb-3">
        <option value="Regular">Regular</option>
        <option value="Fragile">Fragile</option>
        <option value="Liquid">Liquid</option>
        <option value="Chemical">Chemical</option>
      </select>
      
        <button type="submit" name="addPackage" class="btn btn-primary">Add Package</button>
        <button type="submit" name="cancel" class="btn btn-danger" onClick="document.location.href='ControlPanel.php'"  >Cancel</button>

        </form>
    </div>
</body>
</html>