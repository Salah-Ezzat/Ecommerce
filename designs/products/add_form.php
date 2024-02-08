<?php
function Fill($input){
  if(isset($_SESSION[$input]) ){
    $Fill = $_SESSION[$input];
  }else{
    $Fill='';}; echo "$Fill";};

?>

<form method= "post" action="functions/products/insert.php" enctype= "multipart/form-data">
  <div class="form-group">
    <label for="exampleInputProduct1">Product</label>
    <input type="text" name="product" value="<?php Fill('product1');?>" class="form-control" id="exampleInputProduct1" aria-describedby="productHelp">
    <small id="productHelp" class="form-text text-danger"><?php Fill('product') ?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Price</label>
    <input type="text" name="price" value="<?php Fill('price1');?>" class="form-control" id="exampleInputPassword1">
    <small id="exampleInputPassword1" class="form-text text-danger"><?php Fill('price')?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Sale</label>
    <input type="text" name="sale" value="<?php Fill('sale1');?>" class="form-control" id="exampleInputPassword1">
    <small id="exampleInputPassword1" class="form-text text-danger"><?php Fill('sale')?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputImage1">Image</label>
    <input type="file" name="image[]"   class="form-control" multiple="multiple" id="exampleInputImage1" aria-describedby="imageHelp">
    
  </div>
  <div class="form-group">
    <label for="exampleInputDescription1">Description</label>
    <input type="text" name="description" value="<?php Fill('description1');?>" class="form-control" id="exampleInputDescription1" aria-describedby="descriptionHelp">
    <small id="descriptionHelp" class="form-text text-danger"><?php Fill('description')?></small>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" name="category" id="exampleFormControlSelect1">
     
      <?php
      include_once "functions/connect.php";
      $select= "SELECT * FROM categories";
      $query=$conn->query($select);
      if ($query){
        foreach($query as $option){
          $op_Id= $option['id'];
          $op_Category= $option['category'];
          
          echo "<option value='$op_Id'>$op_Category</option>";
        };
      }else{
        echo $conn->error;
      }
      ?>
    
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php session_unset(); ?>