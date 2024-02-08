<?php
session_start();
include "connect.php";


if (isset($_SESSION['id'])){
  $user_id= $_SESSION['id'];
  $product_id= $_GET['pro_id'];
  $quantity= $_POST['quantity'];

  $select= "SELECT * FROM carts WHERE user_id='$user_id'";
  $querySel= $conn->query($select);
  $userProducts=[];
  if($querySel){
    foreach($querySel as $user){
        $x= $user['product_id'];
        if ($product_id == $x){
          $id=$user['id'];
          $oldQuantity= $user['quantity'];
          $newQuantity= $oldQuantity + $quantity;
          $update= "UPDATE carts SET 
          quantity= '$newQuantity'
          WHERE id= $id";
          $queryUpd= $conn->query($update);
          if($queryUpd){
          header("location:../Botique/cart.php");
          exit;
          }else{
          echo $conn->error;
          }
        }
      
    }
      $insert= "INSERT INTO carts
      (product_id , user_id , quantity) 
      VALUE 
      ('$product_id' , '$user_id' , '$quantity')";
      $query= $conn->query($insert);
      if ($query){
      header("location:../Botique/cart.php");

      }else{
      echo $conn->error;
      }; 

   
  }else{
    echo $conn->error;
  }
 

}else{
  header("location:../user_login.php");
}

