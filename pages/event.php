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
    <title>Events</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../css/styles.css">


    
</head>


    
<body> 

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-m ">
      <div class="container-fluid">
      <a class="navbar-brand  text-light  ms-auto  me-auto pe-5"  href="#">Package Events</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="ControlPanel.php">Packages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Customers.php">Customers</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="MyPackages.php">My Packages</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="accountSetting.php?userID=<?php echo $userID ?>">Account Setting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
    </nav>

    <div class="container">

    <button type="button" class="btn btn-danger mt-5 mb-5 " onClick="document.location.href='ControlPanel.php'">Back</button>
    <button type="button" class="btn btn-primary mt-5 mb-5 " onclick="show_pup()">Add Event</button>

    <!-- Start Add Event -->
    <div class="addCard .bg-light bg-gradient" id="pup">
        <img class="add-event-img" src="../css/images/logistics.png" alt="Add Event">

        <form method="post" autocomplete="off">
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="city" placeholder="City" required value=""> </div>
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="address" placeholder="Address"  required value=""> </div>
        <select name="locationType" class="form-select  mb-3">
        <option value="Truck">Truck</option>
        <option value="Plane">Plane</option>
        <option value="Warehouse">Warehouse</option>
        </select>
        <div class="mb-3 mt-3"><input type="number" class="form-control" name="retailID" placeholder="Retail Center ID"  required value=""> </div>
        <select name="status" class="form-select  mb-3">
        <option value="In Transit">In Transit</option>
        <option value="Delivered">Delivered</option>
        <option value="Damaged">Damaged</option>
        <option value="Lost">Lost</option>
        </select>

        <button type="submit" name="addEvent" class="btn btn-primary">Add Event</button>
        <button type="submit" name="cancel" class="btn btn-danger" onclick="hide_pup()" >Cancel</button>

        </form>
    </div>

    <script>        
        function show_pup(){        
            document.getElementById('pup').classList.add('open');
        }
        function hide_pup(){
            document.getElementById('pup').classList.remove('open');
        }
    </script>

    
    <!-- End Add Event -->

        <div class="tableContainer">

<div class="tableHeader mb-0">
<h3> Shipment Number <?php echo $packageNb; ?> </h3>
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
      <th scope="col">Operation</th>

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
        <td>
        <button class="btn btn-danger"><a href="deleteEvent.php?scheduleNb='.$scheduleNb.'" class="operation-btn text-light">Delete</a></button> 
        </td>

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