<?php
include "../../functions/connect.php";

$id= $_GET['id'];
$username= $_POST['username'];
$password= $_POST['password'];
$email= $_POST['email'];
$address= $_POST['address'];
$gender= $_POST['gender'];
$privligies= $_POST['privligies'];

$update= "UPDATE admins SET 
                username = '$username',
                password = '$password',
                email    = '$email',
                address  = '$address',
                gender   = '$gender',
                privligies= '$privligies'       
                         WHERE id=$id";
$query= $conn->query($update);
if($query){
    header ("location:../../admins.php");
}else{
    echo $conn->error;
};