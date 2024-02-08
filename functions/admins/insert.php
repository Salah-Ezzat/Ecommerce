<?php
session_start();
include "../connect.php";
$username= $_POST['username'];
$password= $_POST['password'];
$email= $_POST['email'];
$address= $_POST['address'];
$gender= $_POST['gender'];
$privligies= $_POST['privligies'];
$errors=[];
$values=[];
foreach($_POST as $key=>$value)
    if(empty($value)){
        $errors[]="$key";
    }else{$_SESSION[$key.'1']=$value;};
  
if(count($errors)>0){
foreach($errors as $error){
   $_SESSION[$error]= ucfirst("$error need to be filled");
};


header("location: ../../admins.php?action=add");
}else{
    session_unset();
    $insert="INSERT INTO admins
    (username, password, email, address, gender, privligies) 
    VALUE 
    ('$username', '$password', '$email', '$address', '$gender', '$privligies')"; 
    
$query= $conn->query($insert);
if ($query){
header ("location:../../admins.php");
}else{
echo "$conn->error";
};

};






