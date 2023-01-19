<?php

require '../config/config.php';

// To check if the user is logined in or not
require 'LoginCheck.php';
if($userType == 'employee' || $userType == 'customer'){}
else{
    header('Location: login.php');
}
$userID = $id;
  
$packageNb = $_GET['packageID'];
$sql = "SELECT * FROM `package` WHERE packageNb = $packageNb";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) > 0){
    $price = $row['price'];
    $insuranceAmount = $row['insuranceAmount'];
}

if(isset($_POST["pay"])){
    $sql = "UPDATE `package` SET `paid`='Yes' WHERE packageNb = $packageNb";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: MyPackages.php");
    }else{
        echo "<script> alert('Error Occurred!') </script>";
    }
}

if(isset($_POST["cancel"])){
    header("Location: MyPackages.php");
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
        <img class="package-img" src="../css/images/pay.png" alt="Pay Image">

        <form method="post" autocomplete="off">
        <div class="mb-3 mt-3">
        <h3>Price = <?php echo $price; ?>$</h3>        
        <h3>Insurance Amount = <?php echo $insuranceAmount; ?>$</h3>     
        <br>   
        <h3>Total Amount = <?php echo $insuranceAmount + $price; ?>$</h3>        

    </div>
        
        <select name="paymentMethod" class="form-select  mb-3">
        <option value="Apple Pay">Apple Pay</option>
        <option value="Mada">Mada</option>
        <option value="Cridit Card">Cridit Card</option>

      </select>
        <button type="submit" name="pay" class="btn btn-success">Pay Now</button>
        <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>

        </form>
    </div>
</body>
</html>