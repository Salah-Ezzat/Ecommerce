<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:../user_login.php");
  exit;
};
include "connect.php";
$user_id= $_POST['user_id'];
$date= $_POST['date'];
$rating= $_POST['rating'];
$review= $_POST['review'];
$product_id= $_POST['product_id'];

$insert= "INSERT INTO reviews (user_id , product_id , review , rating , time ) 
                            VALUE 
                              ('$user_id' , '$product_id' , '$review' , '$rating' , '$date')";
$query= $conn->query($insert);
if ($query){
    header("location:../Botique/detail.php?pro_id=$product_id");
}else{
    echo $conn->error;
}
