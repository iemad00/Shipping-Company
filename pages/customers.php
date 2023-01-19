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

if(isset($_POST["addUser"])){
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $userType = $_POST['userType'];

  $dublicate = mysqli_query($conn,"SELECT * FROM `user` WHERE username = '$username' OR phone = '$phone' OR email = '$email'");

    if(mysqli_num_rows($dublicate) > 0){
        echo "<script> alert('Username of Phone number is Already Taken!') </script>";
    }else{

      $sql = "INSERT INTO `user`(`username`,`email`, `phone`, `password`, `userType`) VALUES ('$username','$email','$phone','$password','$userType')";
      $result = mysqli_query($conn,$sql);
      if($result){
        header("Location: customers.php");
    
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
    <title>Customers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


    <link rel="stylesheet" href="../css/styles.css">




</head>


    
<body> 

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-m ">
      <div class="container-fluid">
      <a class="navbar-brand  text-light  ms-auto  me-auto pe-5"  href="#">Customers</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ControlPanel.php">Packages</a>
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
    <button type="button" class="btn btn-primary mt-5 mb-5" onClick="show_pup()" >Add User</button>


    <!-- Start Add User -->
    <div class="addCard .bg-light bg-gradient" id="pup">
        <img class="add-user-img" src="../css/images/team.png" alt="Add User">

        <form method="post" autocomplete="off">
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="username" placeholder="Username" required value=""> </div>
        <div class="mb-3 mt-3"><input type="email" class="form-control" name="email" placeholder="email" required value=""> </div>
        <div class="mb-3 mt-3"><input type="number" class="form-control" name="phone" placeholder="Phone"  required value=""> </div>
        <div class="mb-3 mt-3"><input type="password" class="form-control" name="password" placeholder="password" required value=""> </div>

        <select name="userType" class="form-select  mb-3">
        <option value="customer" selected>Customer</option>
        <option value="employee">Employee</option>
        </select>

        <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
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
    <!-- End Add User -->



<!-- Bootstap Table -->

<table class="table tableCard">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">User Type</th>
      <th scope="col">Operation</th>

    </tr>
  </thead>
  <tbody>


    

<!-- PHP Part to insert Data in table -->
<?php
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    if($result){
    while($row = mysqli_fetch_assoc($result)){
        $userID = $row['id'];
        $username = $row['username'];
        $phone = $row['Phone'];
        $email = $row['Email'];
        $userType = $row['userType'];

        echo '   
        <tr>
        <th scope="row">'.$userID.'</th>
        <td>'.$username.'</td>
        <td>'.$phone.'</td>
        <td>'.$email.'</td>
        <td>'.$userType.'</td>

        <td>
        <button class="btn btn-warning"><a href="editUser.php?userID='.$userID.'" class="operation-btn text-dark a-solid"><i class="fa-solid fa-pen-to-square"></i></a></button> 
        <button class="btn btn-danger"><a href="deleteUser.php?userID='.$userID.'" class="operation-btn text-light fa fa-trash"></a></button> 

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