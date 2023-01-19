<?php

require 'config/config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM `user` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
    $userType = $row["userType"];
    if($userType == 'employee'){
      header('Location: pages/ControlPanel.php');
    }else{
      header('Location: pages/MyPackages.php');
    }


}else{
    header('Location: pages/login.php');
}
