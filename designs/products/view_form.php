<?php

?>
<a type="button" class="btn btn-primary" href="?action=add">Add Product</a>
<br>
<br>

<table>

<table class="table table-striped table-gray">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Sale</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Category</th>
      <th scope="col">Control</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
     include "functions/connect.php";
     $select= "SELECT * FROM products";
     $query= $conn->query($select);
     foreach($query as $product){
    
    ?>
    
    <tr>
      <th scope="row"><?= $product['id']?></th>
      <th ><?= $product['product']?></th>
      <th ><?= $product['price']?></th>
      <th ><?= $product['sale']?></th>
      <th >
      <!-- Button trigger modal -->
<button type="button" class="btn btn-white text-danger font-italic font-weight-light" data-toggle="modal" data-target="#z<?= $product['id']?>">
  Show Images
</button>

<!-- Modal -->
<div class="modal fade" id="z<?= $product['id']?>" tabindex="-2" aria-labelledby="zexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger font-weight-bold" id="zexampleModalLabel"><?= $product['product']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
        
        $product_id= $product['id'];
        $selImgs= "SELECT * FROM images WHERE product_id= '$product_id'";
        $Imgs=$conn->query($selImgs);
        
        foreach($Imgs as $Img){
          $image= $Img['image'];
        
          echo " <img style= ' width:100% ' src='images/$image'>";
          };
      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>  

        <!-- <?php
        
      $product_id= $product['id'];
      $selImgs= "SELECT * FROM images WHERE product_id= '$product_id'";
      $Imgs=$conn->query($selImgs);
      
      foreach($Imgs as $Img){
        $image= $Img['image'];
      
         echo "<div class='modal-dialog modal-fullscreen-sm-down'>
        <img style= ' width:100% ' src='images/$image'>
        </div>";
     
    };
    ?> -->
      </th>
      <th ><?= $product['description']?></th>
      <th >
        <?php
        include_once "functions/connect.php";
        $Cat_id= $product['cat_id'];
        $selectCat= "SELECT * FROM categories where id = $Cat_id";
        $queryCat= $conn->query($selectCat);
        $Category= $queryCat->fetch_assoc();
          $cat= $Category['category'];
          echo "$cat";
      
         ?>
      </th>
      
      <th>
      <a type="button" class="btn btn-primary" href="?action=edit&id=<?= $product['id']?>">Edit</a>
     <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#e<?= $product['id']?>">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="e<?= $product['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger font-weight-bold" id="exampleModalLabel">Delete Confrimation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <span class="text-danger" style="font-weight:bold;"><?= $product['product']?></spane>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-danger" href="functions/products/delete.php?id=<?= $product['id']?>">Confirm</a>
      </div>
    </div>
  </div>
</div>
      </th>
    </tr>
    <?php } ?>
  
  </tbody>
</table>
