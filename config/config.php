<?php

session_start();
$conn = mysqli_connect("localhost","root","","ShippingCompany");

if(!$conn){
    die(mysqli_error($conn));
}
?>