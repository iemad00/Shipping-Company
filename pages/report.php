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



if(isset($_POST['cancel'])){
    header("Location: ControlPanel.php");

}

$sql = "";
if(isset($_POST["createReport"])){
    $username = $_POST['username'];
    $destination = $_POST['destination'];
    $firstDate = $_POST['date1'];
    $secondDate = $_POST['date2'];
    $packageType = $_POST['packageType'];
    $selectedStatus = $_POST['status'];

    if(! empty($username) ){
        $username = "AND user.username = '$username'";
    }

    if(! empty($firstDate) &&  ! empty($secondDate)){
        $dateSql = "AND date BETWEEN '$firstDate' AND '$secondDate  23:59:59'";
    }


    if(! empty($destination) ){   
        $destination = "AND destination = '$destination'";
    }

    if($packageType != "all"){
        $packageType = "AND packageType = '$packageType'";
    }else{
        $packageType = "";

    }

    $sql = "SELECT * FROM user,Package WHERE user.id = package.userID $dateSql $username $destination $packageType";

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>Generate Report</title>
</head>


<body>



</div>
<div class="reportCard .bg-light bg-gradient" id="pup">
        <img class="add-user-img" src="../css/images/report.png" alt="Report Image">
        <form method="post" autocomplete="off">
            <h3>Generate a Report</h3>
            <h5 class="mb-5">make the field empty if you want everything</h5>

        <div class="mb-3 mt-3"><input type="text" class="form-control" name="username" placeholder="Username"> </div>
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="destination" placeholder="destination" > </div>
        
        <div class="row">
            <div class="col">
            <div class="mb-3"><input type="date" class="form-control" name="date1"> </div>
            </div>
            <div class="col">
            <div class="mb-3"><input type="date" class="form-control" name="date2"> </div>
           </div>
        </div>

        <select name="packageType" class="form-select  mb-3">
        <option value="all">Package Type</option>
        <option value="Regular">Regular</option>
        <option value="Fragile">Fragile</option>
        <option value="Liquid">Liquid</option>
        <option value="Chemical">Chemical</option>
      </select>
      <select name="status" class="form-select  mb-3">
        <option value="all">Package Status</option>
        <option value="In Process">In Process</option>
        <option value="In Transit">In Transit</option>
        <option value="Delivered">Delivered</option>
        <option value="Damaged">Damaged</option>
        <option value="Lost">Lost</option>
        </select>
        <button type="submit" name="createReport" class="btn btn-primary">Generate Report</button>
        <button type="submit" name="cancel" class="btn btn-danger" onClick="document.location.href='ControlPanel.php'" >Back</button>
        </form>     

    </div>


</div>


<div class="mt-4 ms-4">
    <button class="btn btn-danger" name="cancel" onClick="document.location.href='ControlPanel.php'">Back</button>
    <button class="btn btn-secondary" onclick="hide();table_up();"><i class="fa-solid fa-sort-up"></i></button>
    <button class="btn btn-secondary" onclick="appear(); table_down();"><i class="fa-solid fa-sort-down"></i></button>  
</div>

<script>        
        function hide(){        
            document.getElementById('pup').classList.add('hide');
        }
        function appear(){
            document.getElementById('pup').classList.remove('hide');
        }
        function table_up(){        
            document.getElementById('up').classList.add('up');
        }
        function table_down(){
            document.getElementById('up').classList.remove('up');
        }
    </script>








<!-- Table -->
<div class="container ps-4 pe-5">
<table class="table reportTable" id="up">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col">Weight</th>
      <th scope="col">Destinition</th>
      <th scope="col">Type</th>
      <th scope="col">Price</th>
      <th scope="col">Paid?</th>
      <th scope="col">Name</th>
      <th scope="col">C-ID</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
  <tbody>


    

    <!-- PHP Part to insert Data in table -->
    <?php
    if(!empty($sql)){
    $result = mysqli_query($conn, $sql);
    if($result){
    while($row = mysqli_fetch_assoc($result)){
        $packageNb = $row['packageNb'];
        $weight = $row['weight'];
        $height = $row['height'];
        $width = $row['width'];
        $length = $row['length'];
        $packageType = $row['packageType'];
        $destination = $row['destination'];
        $dimensionalWeight = ($height*$width*$length)/5000;
        $shippingWeight = (int)max($weight,$dimensionalWeight);
        if($shippingWeight > 2){
            $price = 60 + (($shippingWeight-2) * 15);
        }
        else{
            $price = 30*$shippingWeight;
        }
        $shippingWeight .= " kg";
        $price = (string)$row['price'];
        $price .= "$";
        $username = $row['username'];
        $userID = $row['userID'];
        $date = $row['date'];



        $findEmail = "SELECT * FROM `user` WHERE id = $userID";
        $result3 = mysqli_query($conn, $findEmail);
        $row3 = mysqli_fetch_assoc($result3);
        $email = $row3['Email'];

        $paid = $row['paid'];
        if($paid == "Yes"){
          $option = "disabled";
          $paid = "Confirmed";
      }else{
          $paid = "Not Paid";
      }

      $findStatus = "SELECT * FROM `transportationEvent` WHERE packageNb = $packageNb ORDER BY DATE DESC LIMIT 1";
      $result2 = mysqli_query($conn, $findStatus);
      $row2 = mysqli_fetch_assoc($result2);
      if(mysqli_num_rows($result2) > 0){
        $status = $row2['status'];
      }else{
        $status = 'In Process';
      }

        if($selectedStatus != "all"){

            if($selectedStatus == $status){
                echo '   
                <tr>
                <th scope="row">'.$packageNb.'</th>
                <td>'.$shippingWeight.'</td>
                <td>'.$destination.'</td>
                <td>'.$packageType.'</td>
                <td>'.$price.'</td>
                <td>'.$paid.'</td>
                <td>'.$username.'</td>
                <td>'.$userID.'</td>
                <td>'.$date.'</td>
        
                <td>'.$status.'</td>
        
                </tr>     
                ';
            }

        }else{
            echo '   
            <tr>
            <th scope="row">'.$packageNb.'</th>
            <td>'.$shippingWeight.'</td>
            <td>'.$destination.'</td>
            <td>'.$packageType.'</td>
            <td>'.$price.'</td>
            <td>'.$paid.'</td>
            <td>'.$username.'</td>
            <td>'.$userID.'</td>
            <td>'.$date.'</td>
    
            <td>'.$status.'</td>
    
            </tr>     
            ';
        }




    }
    }
}
    ?>

  </tbody>
</table>

<!-- Table -->







    </div>


    
</body>
</html>