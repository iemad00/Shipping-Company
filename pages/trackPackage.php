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
$url = 'event.php?packageID=';
$url .= $packageNb;
if(isset($_POST["addEvent"])){
    $city = $_POST['city'];
    $address = $_POST['address'];
    $locationType = $_POST['locationType'];
    $retailID = $_POST['retailID'];
    $status = $_POST['status'];


    $sql = "SELECT * FROM `retailCenter` WHERE id = $retailID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 0){    
        echo "<script>
        window.location.href = '$url';
        alert('Wrong Retail Center ID !');
  </script>";

    }
    
    $sql = "SELECT * FROM `location` WHERE city = '$city' AND address = '$address' AND locationType = '$locationType'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){    
        $locationID = $row['id'];
    }
    else{

        $sql = "INSERT INTO `location`( `city`, `address`, `locationType`, `retailCenterID`) VALUES ('$city','$address','$locationType',$retailID)";
        $result = mysqli_query($conn,$sql);

        if($result){    
            $sql = "SELECT * FROM `location` WHERE city = '$city' AND address = '$address' AND locationType = '$locationType'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $locationID = $row['id'];
        }else{
            echo "<script> alert('Error Occurred! Location') </script>";
        }
    }
    $sql = "INSERT INTO `transportationEvent`(`packageNb`, `locationID`, `status`) VALUES ($packageNb,$locationID,'$status')";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: $url");
    }else{
        echo "<script> alert('Error Occurred!') </script>";
    }


    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../css/styles.css">


    
</head>


    
<body> 

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-m mb-5">
      <div class="container-fluid">
      <a class="nav-link text-light" href="logout.php">Logout</a>

    <a class="navbar-brand  text-light  ms-auto  me-auto pe-5" href="#">Tracking Page</a>

  </div>
    </nav>


    <div class="container">

    <div class="container">

    <button type="button" class="btn btn-danger mt-5 mb-5 " onClick="document.location.href='MyPackages.php'">Back</button>

    <div class="tableContainer">

<div class="tableHeader mb-0">
<h3> Track Shipment Number <?php echo $packageNb; ?> </h3>
</div>

<div class="tableBody">


<table class="table">
  <thead>
    <tr>
      <th scope="col">Time</th>
      <th scope="col">City</th>
      <th scope="col">Address</th>
      <th scope="col">Location Type</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
  <tbody>


    

    <!-- PHP Part to insert Data in table -->
    <?php
    $packageNb = $_GET['packageID'];
$sql = "SELECT `location`.*,transportationEvent.* FROM `package`,`transportationEvent`,`location` WHERE package.packageNb = $packageNb AND package.packageNb = transportationEvent.packageNb AND transportationEvent.locationID = location.id  ORDER BY transportationEvent.date DESC";
$result = mysqli_query($conn, $sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $date = $row['Date'];
        $city = $row['city'];
        $address = $row['address'];
        $locationType = $row['locationType'];
        $status = $row['status'];
        $scheduleNb = $row['scheduleNb'];
        echo '   
        <tr>
        <th scope="row">'.$date.'</th>
        <td>'.$city.'</td>
        <td>'.$address.'</td>
        <td>'.$locationType.'</td>
        <td>'.$status.'</td>

        </tr> 
        ';
    }
}
    ?>

  </tbody>
</table>


    
</div>


        </div>


    </div>





</body>
</html>