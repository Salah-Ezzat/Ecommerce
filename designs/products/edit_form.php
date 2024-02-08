<?php
include "functions/connect.php";
$id = $_GET['id'];
$select= "SELECT * FROM products WHERE id= $id";
$query= $conn->query($select);
$product= $query->fetch_assoc();
?>

<form method= "post" action="functions/products/update.php?id=<?=$id?>" enctype= "multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Product</label>
    <input type="text" name="product" value="<?=$product['product']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Price</label>
    <input type="text" name="price" value="<?=$product['price']?>" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Sale</label>
    <input type="text" name="sale" value="<?=$product['sale']?>" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" name="image[]" multiple="multiple" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <input type="text" name="description" value="<?=$product['description']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" name="category" id="exampleFormControlSelect1">
      <?php 
      $selectCat="SELECT * FROM categories";
      $queryCat=$conn->query($selectCat);
      foreach($queryCat as $Cat){
        $Cat_id= $Cat['id'];
        $category= $Cat['category'];
        echo "<option value='$Cat_id'>$category</option>";

      }
      ?>
     
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
