<?php
session_start();
include "../connect.php";
$username= $_POST['username'];
$password=$_POST['password'];
$select= "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$query= $conn->query($select);


if ($query->num_rows>0){
    $check= $query->fetch_assoc();
    $_SESSION['id']= $check['id'];
    $_SESSION['username']=$check['username'];
    header("location:../../Botique/shop.php");

}else { $_SESSION['error']="Wrong Credentials";
    header("location:../../user_login.php");

}