<?php

session_start();
 include "../connect.php";
$product = $_POST['product'];
$price= $_POST['price'];
$sale= $_POST['sale'];
$description= $_POST['description'];
$category= $_POST['category'];
$errors =[];

foreach($_POST as $key=>$value)
    if(empty($value)){
            $errors[]="$key";
        }else{$_SESSION[$key.'1']=$value;};
   
        if(count($errors)>0){
            foreach($errors as $error){
               $_SESSION[$error]= ucfirst("$error need to be filled");
            };
            header("location: ../../products.php?action=add");
            }else{
                session_unset();
            };
            $insert="INSERT INTO products
            (product, price, sale, description, cat_id) 
            VALUE 
            ('$product', '$price', '$sale', '$description', '$category')"; 
            
                $query= $conn->query($insert);

                if ($query){
                $product_id= $conn->insert_id;
                }else{
                echo "$conn->error";
                };

                
                    $count= count($_FILES['image']['name']);
                for($i=0; $i<$count; $i++){

                $imgName= $_FILES['image']['name'][$i];
                $temp= $_FILES['image']['tmp_name'][$i];


                if($_FILES['image']['error'][$i]==0){
                    $extensions= ['jpg', 'jpeg', 'png'];
                    $ext= pathinfo($_FILES['image']['full_path'][$i], PATHINFO_EXTENSION);
                    if(in_array($ext, $extensions)){
                        if($_FILES['image']['size'][$i]< 2000000){
                            $newName[$i]= md5(uniqid()).".".$ext;
                            move_uploaded_file($temp,"../../images/$newName[$i]");
                          

                            $insertImage="INSERT INTO images 
                                        (image, product_id) VALUE ('$newName[$i]','$product_id')";
                            $queryImg= $conn->query($insertImage);
                            if($queryImg){
                                header ("location:../../products.php");
                                }else{echo "$conn->error";};
                        
                        
                    
                        }else{ echo "Image size is too large";}

                    }else{
                        echo "File uploaded is not an image";
                    }
                }else{ 
                    echo "No images uploaded";
                };
                    
                };

                