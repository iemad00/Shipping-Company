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
        <nav class="navbar navbar-dark bg-dark navbar-expand-m mb-5">
      <div class="container-fluid">
      <a class="navbar-brand  text-light  ms-auto  me-auto pe-5"  href="#">Tracking Page</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
        <a class="nav-link <?php if($userType == "customer") { echo 'disabled text-dark' ; } ?>" href="ControlPanel.php">Control Panel</a>
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

    <button type="button" class="btn btn-primary mt-5 mb-5" onClick="document.location.href='addPackage.php'" >Add Package</button>

    



<!-- Bootstap Table -->


    <table id="example" class="table text-center" style="width:100%">
        <thead >
        <tr>
            
      <th scope="col">P-ID</th>
      <th scope="col">Weight</th>
      <th scope="col">Destinition</th>
      <th scope="col">Type</th>
      <th scope="col">Price</th>      
      <th scope="col">Payed?</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">Operation</th>

    </tr>
        </thead>
        <tbody>


    

<!-- PHP Part to insert Data in table -->
    <?php include("DataToTable.php");?>




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