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

//To get the ID 
$userID = $_GET['userID'];
$sql = "SELECT * FROM `user` WHERE `id` = $userID";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$oldName = $row['username'];
$oldPhone = $row['Phone'];
$oldEmail = $row['Email'];
$password = $row['password'];
$userType = $row['userType'];

if(isset($_POST['cancel'])){
    header("Location: customers.php");

}

if(isset($_POST["editUser"])){

    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];


    try{
        $sql = "UPDATE `user` SET `username`='$username',`Email`='$email',`Phone`=$phone ,`password`='$password',`userType`='$userType' WHERE `id` = $userID";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location: customers.php");
        }else{
            echo "<script> alert('Error Occurred!') </script>";
        }
    }catch(Exception){
        echo "<script> alert('New Username or Email or Phone is already Taken!') </script>";
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
        <img class="add-user-img" src="../css/images/team.png" alt="Team Image">
        <form method="post" autocomplete="off">
        <div class="mb-3 mt-3"><input type="text" class="form-control" name="username" placeholder="Username" required value=<?php echo $oldName; ?>> </div>
        <div class="mb-3 mt-3"><input type="email" class="form-control" name="email" placeholder="email" required value=<?php echo  $oldEmail; ?>> </div>
        <div class="mb-3 mt-3"><input type="number" class="form-control" name="phone" placeholder="Phone"  required value=<?php echo $oldPhone; ?>> </div>
        <div class="mb-3 mt-3"><input type="password" class="form-control" name="password" placeholder="password" value=<?php echo $password; ?>> </div>

        <select name="userType" class="form-select  mb-3">
        <option value="customer" <?=$userType == 'customer' ? ' selected="selected"' : '';?>>Customer</option>
        <option value="employee" <?=$userType == 'employee' ? ' selected="selected"' : '';?>>Employee</option>
        </select>

        <button type="submit" name="editUser" class="btn btn-primary">Edit User</button>
        <button type="submit" name="cancel" class="btn btn-danger" onClick="document.location.href='customers.php'" >Cancel</button>

        </form>
    </div>
</body>
</html>