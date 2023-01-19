<?php

require '../config/config.php';
if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $dublicate = mysqli_query($conn,"SELECT * FROM `user` WHERE username = '$username' OR phone = '$phone' OR email = '$email'");

    if(mysqli_num_rows($dublicate) > 0){
        echo "<script> alert('Username of Phone number is Already Taken!') </script>";
    }else{
        if($password != $confirmPassword){
            echo "<script> alert('Password Does Not Match!') </script>";
        }
        else{
            $query = "INSERT INTO `user`(`username`,`email`, `phone`, `password`) VALUES ('$username','$email','$phone','$password')";
            mysqli_query($conn,$query);
            echo "<script> alert('Registration Successful') </script>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../css/styles.css">

    <title>Register</title>
</head>
<body class="logreg-body">


    <div class="reg-main-container">
        <form method="post" autocomplete="off">
            <img src="../css/images/user.png" alt="Login icon" class="login-icon">
            <div>
                <input class="mt-0" type="text" name="username" placeholder="Username" required value="">
                <input class="mt-3" type="email" name="email" placeholder="Email Address" required value="">
                <input class="mt-3" type="text" name="phone" placeholder="Phone Number" required value="">
                <input class="mt-3" type="password" name="password"  placeholder="Password" required value="">
                <input class="mt-3" type="password" name="confirmPassword"  placeholder="Confirm Password" required value="">

            </div>

            <button class="mt-3 lg-button" name="submit">Sign up</button>

            <div> <a href="login.php">Sign in</a> </div>
        </form>
    </div>

    
</body>
</html>