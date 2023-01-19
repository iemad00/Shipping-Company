<?php
require '../config/config.php';



if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn,"SELECT * FROM `user` WHERE (username = '$username' OR email = '$username') AND password = '$password'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["id"];

        $userType = mysqli_query($conn,"SELECT * FROM `user` WHERE username = '$username'");
        $row = mysqli_fetch_assoc($userType);

        if($row["userType"] == 'employee'){
            header('Location: ControlPanel.php');
        }else{
            header('Location: MyPackages.php');
        }

        


        echo "<script> alert('Login successfully!') </script>";
    }else{
        echo "<script> alert('Wrong Username or Password') </script>";
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

    <title>Login</title>
</head>
<body class="logreg-body">


    <div class="log-main-container">

        <form method="post" autocomplete="off">
            <img src="../css/images/user.png" alt="Login icon" class="login-icon">
            <div>
                <input class="mt-0" type="text" name="username" placeholder="Username or Email" required value="">
                <input class="mt-3" type="password" name="password"  placeholder="Password" required value="">
            </div>

            <button class="mt-3 lg-button" name="submit">Sign in</button>
            <div> <a href="register.php">Sign up</a> </div>

        </form>
    </div>

    
</body>
</html>