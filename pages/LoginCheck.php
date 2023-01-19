<?php

require '../config/config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $result = mysqli_query($conn,"SELECT * FROM `user` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
    $userType = $row["userType"];
}
