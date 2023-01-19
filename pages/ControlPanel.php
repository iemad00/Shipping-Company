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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/styles.css"> 

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>


    
<body> 

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-m ">
      <div class="container-fluid">
    <a class="navbar-brand  text-light  ms-auto  me-auto pe-5"  href="#">Control Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Packages</a>
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


    <div class="container ps-4 pe-5">

    <button type="button" class="btn btn-primary mt-5 mb-5" onClick="document.location.href='addPackage.php'" >Add Package</button>
    <button type="button" class="btn btn-secondary mt-5 mb-5" onClick="document.location.href='report.php'" >Make a Report</button>




<!-- Bootstap Table -->


    <table id="example" class="table text-center" style="width:100%">
        <thead >
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
      <th scope="col">Operation</th>

    </tr>
        </thead>
        <tbody>


    

<!-- PHP Part to insert Data in table -->
    <?php
    $sql = "SELECT * FROM package,user WHERE package.userID = user.id ORDER BY package.date DESC";
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

        $findStatus = "SELECT * FROM `transportationEvent` WHERE packageNb = $packageNb ORDER BY DATE DESC LIMIT 1";
        $result2 = mysqli_query($conn, $findStatus);
        $row2 = mysqli_fetch_assoc($result2);
        if(mysqli_num_rows($result2) > 0){
          $status = $row2['status'];
        }else{
          $status = 'In Process';
        }

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

        <td>
        <button class="btn btn-warning"><a href="editPackage.php?packageID='.$packageNb.'" class="operation-btn text-dark a-solid"><i class="fa-solid fa-pen-to-square"></i></a></button> 
        <button class="btn btn-primary"><a href="event.php?packageID='.$packageNb.'" class="operation-btn text-light " style=""><i class="fa-solid fa-calendar-days"></i></a></button> 
        <button class="btn btn-danger"><a href="deletePackage.php?packageID='.$packageNb.'" class="operation-btn text-light fa fa-trash"></a></button> 
        <button class="btn btn-success "><a href="mailto:'.$email.'"><i class="fa-solid fa-envelope text-light"></i></a></button> 

        </tr>     
        ';
    }
    }
    ?>



</tbody>
    </table>


       <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
         <script>
                $(document).ready(function () {
                   $('#example').DataTable();
                 });
     </script>

<!-- Bootstrap end Table -->


    </div>





</body>
</html>