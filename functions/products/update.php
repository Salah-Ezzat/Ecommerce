<?php
include "../../functions/connect.php";

$id= $_GET['id'];
$product= $_POST['product'];
$price= $_POST['price'];
$sale= $_POST['sale'];
$description= $_POST['description'];
$category= $_POST['category'];

$update= "UPDATE products SET 
                product = '$product',
                price = '$price',
                sale    = '$sale',
                description  = '$description',
                cat_id   = '$category'                      
                         WHERE id=$id";

$query= $conn->query($update);
if($query){
    $count= count($_FILES['image']['name']);
    if($count==1 && $_FILES['image']['error']==4){
    header ("location:../../products.php");
    }else{
        $del= "DELETE FROM images WHERE product_id= $id";
        $queryDel= $conn->query($del);
        if($queryDel){
           
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
                                    (image, product_id) VALUE ('$newName[$i]','$id')";
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

        }
    }
}
}else{
    echo $conn->error;
};